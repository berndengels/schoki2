<?php
namespace App\Http\Controllers;

use Exception;
use App\Models\Customer;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;
use App\Repositories\ShopRepository;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Http\Resources\Payment\PayPal\ShippingResource;

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

        $shippingAddress = new ShippingResource(Shipping::find($request->input('shipping')));
        $product = [];
        $product['items'] = ShopRepository::getCartItemsArray($cart, 'paypal', $request);
        $product['invoice_id']  = $invoiceId;
        $product['invoice_description'] = "Shokoladen Order #{$product['invoice_id']}";
        $product['return_url']  = route('public.payment.paypal.success');
        $product['cancel_url']  = route('public.payment.paypal.cancel');
        $product['total']       = $cart->priceTotal();
        $product['shipping']    = $shippingAddress;

        try {
            $paypal = new ExpressCheckout;
            $result = $paypal->setExpressCheckout($product, true);
            if(isset($result['paypal_link'])) {
                session('orderCheckout', [
                    'provider'  => 'paypal',
                    'order'     => $product
                ]);
                return redirect($result['paypal_link']);
            }
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function cancel(Request $request, Cart $cart)
    {
        echo __METHOD__.'<br>';
        dd($request->input());
    }

    public function success(Request $request, Cart $cart)
    {
         /**
          * @todo: Order, Invoice, Dispatch Event paymentSuccess
          * @todo: get session('orderCheckout') for order storing in destroy after that
          */
        try {
            $paypal = new ExpressCheckout;
            $response = $paypal->getExpressCheckoutDetails($request->token);

            if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
                dd('Payment was successfull. The payment success page goes here!');
            }
            dd('Error occured!');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
