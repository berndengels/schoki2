<?php
namespace App\Http\Controllers;

use Exception;
use App\Helper\MyCart;
use App\Models\WebhookPaypal;
use App\Models\Customer;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;
use App\Repositories\ShopRepository;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Http\Resources\Payment\PayPal\ShippingResource;
use Spatie\TaxCalculator\TaxCalculation;
use Spatie\TaxCalculator\Results\CalculationWithRate;

class PaymentPayPalController extends Controller
{
    public function process(Request $request, Cart $cart)
    {
//        dd($cart->content());
        /**
         * @var Customer $customer
         */
        $customer = auth('web')->user();
        $invoiceId = date('YmdHis') .'-'. $customer->email;
        $customer->setAppends(['invoiceId' => $invoiceId] );

        $order = ShopRepository::createOrderByCart($customer, $cart);
        $product = [];

        $items      = ShopRepository::getCartItems($cart, 'paypal', $request);
        $tax        = TaxCalculation::fromCollection($items)->taxPrice();
        $subtotal   = TaxCalculation::fromCollection($items)->basePrice();
        $total      = TaxCalculation::fromCollection($items)->taxedPrice();

        $product['invoice_id']  = $invoiceId;
        $product['items']       = json_decode($items->values()->toJson(), true);
        $product['invoice_description'] = "Shokoladen Order #{$invoiceId}";
        $product['return_url']  = route('payment.paypal.success', ['orderId' => $order->id]);
        $product['cancel_url']  = route('payment.paypal.cancel');
        $product['subtotal']    = $subtotal;
        $product['total']       = $total;
        $product['tax']         = $tax;
//        $product['shipping']    = $shippingAddress;
        $product['shipping']    = 0;

        try {
            $paypal = new ExpressCheckout();
            $result = $paypal->setExpressCheckout($product);
            if(isset($result['paypal_link'])) {
                return redirect($result['paypal_link']);
            }
        } catch(Exception $e) {
            throw new $e;
        }
    }

    public function cancel(Request $request)
    {
        return view('public.payment.cancel', compact('request'));
    }

    public function success(Request $request, $orderId = null)
    {
        /**
         * @var Customer $customer
         */
        $customer = $request->user('web');
        dd($orderId);

         /**
          * @todo: Order, Invoice, Dispatch Event paymentSuccess
          * @todo: get session('orderCheckout') for order storing in destroy after that
          */
        try {
            $paypal = new ExpressCheckout;
            $response = $paypal->getExpressCheckoutDetails($request->token);

            if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
                return view('public.payment.success', compact('response'));
            }
//            return view('public.payment.success', compact('customer'));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function webhook(Request $request) {
        $data = [
            'name'  => 'paypal',
            'payload'  => json_encode($request->input()),
        ];
        WebhookPaypal::create($data);
    }
}
