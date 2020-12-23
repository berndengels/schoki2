<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use App\Helper\MyCart;
use App\Libs\PayPal\PayPal;
use App\Models\Webhook;
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
        /**
         * @var Customer $customer
         */
        $customer = auth('web')->user();
        $invoiceId = date('YmdHi') .'-'. $customer->email;
        $customer->setAppends(['invoiceId' => $invoiceId]);

        $items  = ShopRepository::getCartItems($cart, 'paypal', $request);
        $arrItems = $items->map( function($i) use($request) { return $i->toArray($request); })->values()->toArray();
        $address = (new ShippingResource($customer->shipping))->toArray($request);
        $currencyCode = config('paypal.currency');
        $shipping = 0;

        $order  = ShopRepository::createOrderByCart($customer, $cart);

        $params = [
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.paypal.success', ['orderId' => $order->id]),
                "cancel_url" => route('payment.paypal.cancel')
            ],
            "purchase_units" => [
                [
                    "reference_id"  => $order->id,
                    "description"   => "Schokoladen Shop Bestellung",
                    "invoice_id"    => "Schokoladen-$invoiceId",
                    "payer" => [
                        "name"  => $customer->name,
                        "email_address" => $customer->email,
                        "address"   => $address
                    ],
                    "amount" => [
                        "currency_code"  => $currencyCode,
                        "value"  => round(TaxCalculation::fromCollection($items)->taxedPrice(), 2),
                        "breakdown"  => [
                            "item_total"        => [
                                "currency_code" => $currencyCode,
                                "value"         => round(TaxCalculation::fromCollection($items)->basePrice(), 2)
                            ],
                            "tax_total"         => [
                                "currency_code" => $currencyCode,
                                "value"         => round(TaxCalculation::fromCollection($items)->taxPrice(), 2)
                            ],
                            "shipping"          => [
                                "currency_code" => $currencyCode,
                                "value"         => $shipping
                            ],
                            "shipping_discount" => [
                                "currency_code" => $currencyCode,
                                "value"         => $shipping
                            ]
                        ],
                        "items"  => [$arrItems]
                    ]
                ]
            ]
        ];

        try {
            $paypal = new PayPal();
            $result = $paypal->checkout($params);

            if(isset($result->status) && 'CREATED' === $result->status ) {
                $links = $result->links;
                $approveLink = collect($links)->firstWhere('rel','===','approve')->href;
                return redirect($approveLink)->with(['orderId' => $order->id]);
            }
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function success(Request $request, $orderId = null)
    {
        /**
         * @var Customer $customer
         */
        $customer = $request->user('web');
        $order = null;
        if($orderId) {
            $order = Order::find($orderId);
        }

         /**
          * @todo: Order, Invoice, Dispatch Event paymentSuccess
          * @todo: get session('orderCheckout') for order storing in destroy after that
          */
         return view('public.payment.paypal.success', compact('customer', 'order'));
    }

    public function cancel(Request $request)
    {
        return view('public.payment.paypal.cancel', compact('request'));
    }
}
