<?php
namespace App\Http\Controllers;

use Exception;
use Stripe\Price;
use Stripe\StripeClient;
use App\Models\Customer;
use App\Helper\MyLang;
use App\Models\Shoppingcart;
use Gloudemans\Shoppingcart\CartItem;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;
use Stripe\Customer as StripeCustomer;
use App\Repositories\ShopRepository;
use App\Http\Resources\Payment\Stripe\CustomerResource;

class PaymentStripeController extends Controller
{
    /**
     * @var string
     */
    protected $sessionName = 'scart';
    /**
     * @var string
     */
    protected $sid;
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
        $sid = $_SESSION[$this->sessionName];
        $shoppincart = Shoppingcart::whereIdentifier($sid)->first();
        if(!$shoppincart) {
            $cart->store($sid);
        }

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

            $metadata = [
                'order_id'  => null,
            ];
            /**
             * @var Session $stripeSession
             */
            $stripeSession = $this->stripeClient->checkout->sessions->create([
                'payment_method_types' => $paymentMethods,
                'customer'          => $stripeCustomer,
                'mode'              => 'payment',
                'locale'            => MyLang::getPrimary(),
                'line_items'        => $orderItems,
                'metadata'          => $metadata,
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

    public function cancel(Customer $customer, Cart $cart)
    {
        // @todo: maybe destroy cart here
        return view('public.payment.cancel', compact('customer','cart'));
    }

    public function success(Customer $customer, Cart $cart)
    {
        return view('public.payment.success', compact('customer','cart'));
    }

    public function config()
    {
        return response()->json(['publicKey' => env('STRIPE_KEY')]);
    }
}
