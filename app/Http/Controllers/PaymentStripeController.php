<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Exception;
use Carbon\Carbon;
use Laravel\Cashier\Invoice;
use Stripe\Price;
use Stripe\StripeClient;
use App\Models\Customer;
use App\Helper\MyLang;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;
use Gloudemans\Shoppingcart\CartItem;
use Stripe\Customer as StripeCustomer;
use App\Repositories\ShopRepository;
use App\Http\Resources\Payment\Stripe\PortoPrice;
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

    public function create(Cart $cart)
    {
        return view('public.payment.stripe.create', compact('cart'));
    }

    public function process(Request $request, Cart $cart)
    {
        /**
         * @var Customer $customer
         * @var StripeCustomer $stripeCustomer
         */
        $customer = $request->user('web');
        $customerData = (new CustomerResource($customer))->toArray($request);

        try {
            $stripeCustomer = $customer->createOrGetStripeCustomer($customerData);
        } catch (Exception $e) {
            throw new Exception($e);
        }

        $stripeCustomerID = $stripeCustomer->id;
        $paymentMethods = config('my.payment.types');

        // create taxRate
        $params = [
            'display_name' => 'VAT',
            'description' => 'VAT Germany',
            'jurisdiction' => 'DE',
            'percentage' => env('PAYMENT_TAX_RATE'),
            'inclusive' => true,
        ];
        $taxRate = $this->stripeClient->taxRates->create($params);
        // create Porto taxRate
        $params = [
            'display_name' => 'VAT',
            'description' => 'VAT Germany',
            'jurisdiction' => 'DE',
            'percentage' => 0,
            'inclusive' => true,
        ];
        $taxRatePorto = $this->stripeClient->taxRates->create($params);

        // create prices by cartItems
        $prices = ShopRepository::getStripePriceItems($cart, $request);

        $stripePrices = $prices->map(function ($price, $cartItemId) use ($stripeCustomerID, $cart) {
            $cartItem = $cart->get($cartItemId);
            $stripePrice = $this->stripeClient->prices->create($price);
            $params = [
                'customer' => $stripeCustomerID,
                'price' => $stripePrice->id,
                'description' => $cartItem->name,
                'quantity' => $cartItem->qty,
                'metadata' => [
                    'size'          => $cartItem->options['size'] ?? null,
                    'product_id'    => $cartItem->options['product_id'] ?? null,
                ],
            ];
            // create invoice Items
            $this->stripeClient->invoiceItems->create($params);
            return [
                'price' => $stripePrice,
                'cartItemId' => $cartItemId,
            ];
        });
        // create porto
        $porto = PortoPrice::get($cart);
        $portoPrice = $this->stripeClient->prices->create($porto);

        $params = [
            'customer' => $stripeCustomerID,
            'price' => $portoPrice->id,
            'description' => 'Porto Versandkosten',
            'quantity' => 1,
            'tax_rates' => [$taxRatePorto],

        ];
        // create invoice Items
        $this->stripeClient->invoiceItems->create($params);

        // create invoice
        $params = [
            'customer' => $stripeCustomerID,
            'auto_advance' => true,
            'description' => 'Rechnung für Schokoladen Bestellung vom ' . Carbon::today()->format('d.m.Y H:i'),
            'default_tax_rates' => [$taxRate, $taxRatePorto],
        ];
        /**
         * @var Invoice
         */
        $invoice = $this->stripeClient->invoices->create($params);
        $invoice->finalizeInvoice();

        // create order, must be updated by webhook event 'checkout.session.completed'
        $orderItems = $stripePrices->map(function ($item) use ($cart) {
            /**
             * @var Price $price
             * @var CartItem $cartItem
             */
            $price = $item['price'];
            $cartItem = $cart->get($item['cartItemId']);
            return [
                'price' => $price->id,
                'quantity' => $cartItem->qty,
            ];
        })->values()->toArray();

        $orderItems[] = [
            'price' => $portoPrice->id,
            'quantity' => 1,
        ];

        $order = ShopRepository::createOrderByCart($customer, $cart, $porto['unit_amount']);

        try {
            $params = [
                'payment_method_types' => $paymentMethods,
                'customer' => $stripeCustomerID,
                'mode' => 'payment',
                'locale' => MyLang::getPrimary(),
                'line_items' => $orderItems,
                // set metadata for using in webhook response
                'metadata' => [
                    'order_id' => $order ? (int)$order->id : null,
                    'customer_id' => (int)$customer->id,
                ],
                'success_url' => route('payment.stripe.success'),
                'cancel_url' => route('payment.stripe.cancel'),
            ];
            /**
             * create a checkout session and listen on related webhook event
             * on App\Jobs\StripeWebhooks\HandleSessionCheckout
             * @var Session $stripeSession
             */
            $stripeSession = $this->stripeClient->checkout->sessions->create($params);
            // warenkorb leeren
            $cart->destroy();

            return response()->json(['sessionId' => $stripeSession->id]);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function cancel(Customer $customer)
    {
        // @todo: maybe destroy cart here
        return view('public.payment.stripe.cancel', compact('customer'));
    }

    public function success(Request $request)
    {
        /**
         * @var Customer $customer
         */
        $customer = $request->user();
        $invoices = $customer->invoicesIncludingPending();
        return view('public.payment.stripe.success', compact('customer', 'invoices'));
    }

    public function listInvoices(Customer $customer)
    {
        $invoices = $customer->invoices()->toArray();
    }

    public function invoice(Request $request, string $invoiceId)
    {
        $filename = Carbon::now()->format('YmdHi') . '-schokladen-rechnung';
        /** @var Customer $customer */
        $customer = $request->user();
        $logo = base64_encode(file_get_contents(public_path('img') . '/logo-167x167.png'));

        return $customer->downloadInvoice($invoiceId, [
            'vendor' => json_decode(json_encode(config('my.vendor'))),
            'logo' => $logo,
            'product' => 'Ihre aktuelle Bestellung',
            'id' => $invoiceId,
            'vat' => env('PAYMENT_TAX_RATE'),
        ], $filename);
    }

    public function download(string $token)
    {
        $download = Download::findOrFail($token);
        $customerId = $download->customer_id;
        $invoiceId = $download->object_id;

        /** @var Customer $customer */
        $customer = Customer::find($customerId);
        $logo = base64_encode(file_get_contents(public_path('img') . '/logo-167x167.png'));
        try {
            $invoice = $customer->findInvoice($invoiceId);
        } catch (Exception $e) {
            $title = 'Fehler';
            $message = 'Kann keine korrekten Daten finden';
            return view('errors.message', compact('message', 'title'));
        }
        $fileName = Carbon::now()->format('YmdHi') . '_Schokoladen-Bestellung.pdf';
        $data = [
            'vendor' => json_decode(json_encode(config('my.vendor'))),
            'logo' => $logo,
            'product' => 'Schokoladen-Bestellung',
            'id' => $invoiceId,
            'vat' => env('PAYMENT_TAX_RATE'),
        ];
        return $invoice->downloadAs($fileName, $data);
    }

    public function config()
    {
        return response()->json(['publicKey' => env('STRIPE_KEY')]);
    }
}
