<?php
namespace App\Http\Controllers;

use App\Helper\MyLang;
use App\Http\Resources\Payment\Stripe\PriceResource;
use Exception;
use Gloudemans\Shoppingcart\CartItem;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Stripe\Price;
use Stripe\Stripe;
use Stripe\StripeClient;
use App\Models\Customer;
use App\Models\Shipping;
use Stripe\PaymentMethod;
use Laravel\Cashier\Billable;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;
use Stripe\Customer as StripeCustomer;
use App\Repositories\ShopRepository;
use Stripe\Checkout\Session as CheckoutSession;
use App\Http\Resources\Payment\Stripe\ShippingResource;
use Stripe\Exception\ApiErrorException;
use App\Http\Resources\Payment\Stripe\CustomerResource;

class PaymentStripeController extends Controller
{
    /**
     * @var StripeClient $stripClient
     */
    protected $stripeClient;

    public function __construct()
    {
        $this->stripeClient = new StripeClient(env('STRIPE_SECRET'));
    }

    public function create(Request $request, Cart $cart)
    {
        return view('public.payment.create', compact('cart'));
    }

    public function process(Request $request, Cart $cart)
    {
        try {
            /**
             * @var Customer $customer
             * @var StripeCustomer $stripeCustomer
             */
            $customer       = $request->user('web');
            $stripeCustomer = $customer->createOrGetStripeCustomer();

            $paymentMethods = config('my.payment.types');

            $customerData   = new CustomerResource($customer);
            $stripeCustomer->updateAttributes($customerData->toArray($request));

            $prices = ShopRepository::getStripePriceItems($cart, $request);

            $stripePrices = $prices->map(function($price, $cartItemId) {
                return [
                    'price' => $this->stripeClient->prices->create($price),
                    'cartItemId' => $cartItemId,
                ];
            });

            $orderItems = $stripePrices->map(function($item) use ($cart) {
                /**
                 * @var Price $price
                 * @var CartItem $cartItem
                 */
                $price = $item['price'];
                $cartItem = $cart->get($item['cartItemId']);
                return [
                    'price' => $price->id,
                    'quantity'  => $cartItem->qty,
                ];
            })->values()->toArray();

            /**
             * @var Session $stripeSession
             */
            $stripeSession = $this->stripeClient->checkout->sessions->create([
                'payment_method_types' => $paymentMethods,
                'customer'          => $stripeCustomer,
                'mode'              => 'payment',
                'locale'            => MyLang::getPrimary(),
                'line_items'        => $orderItems,
                'success_url'       => route('payment.stripe.success'),
                'cancel_url'        => route('payment.stripe.success'),
            ]);

            return response()->json(['sessionId' => $stripeSession->id]);
        }
        catch(Exception $e) {
            $title      = __METHOD__;
            $code       = $e->getCode();
            $message    = $e->getMessage();
            $trace      = $e->getTraceAsString();

            return view('errors.trace', compact('title','code', 'message', 'trace'));
        }
    }

    public function cancel(Cart $cart)
    {
        // @todo: maybe destroy cart here
        return view('public.payment.cancel', compact('exception'));
    }

    public function success(Cart $cart)
    {
//        $data = $this->stripClient->checkout->sessions->retrieve($id);
        return view('public.payment.success', compact('session','cart'));
    }

    public function config()
    {
        return response()->json(['publicKey' => env('STRIPE_KEY')]);
    }
}
