<?php

namespace App\Http\Controllers;

use App\Forms\PaymentForm;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Laravel\Cashier\Billable;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Gloudemans\Shoppingcart\Cart;
use Stripe\HttpClient\ClientInterface;
use Stripe\Service\SourceService;
use Stripe\Source;

class PaymentStripeController extends Controller
{
    use FormBuilderTrait;
    /**
     * @var Customer;
     */
    protected $customer;
    public function __construct() {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index( FormBuilder $formBuilder, Cart $cart )
    {
        /**
         * @var Billable $user
         */
        $user = auth('web')->user();
        $this->customer = $user->createOrGetStripeCustomer();
        $configPayments = collect(config('my.paymentMethods'));
        $paymentOptions = $configPayments->map(function ($method, $key){
            return $method[$key] = $method['label'];
        })->toArray();

        $form   = $formBuilder->create(PaymentForm::class, [], [
            'user' => $user,
            'paymentOptions' => $paymentOptions,
        ]);
        return view('public.form.payment', compact('form', 'configPayments'));
    }

    public function billingPortal(Request $request)
    {
        return $request->user()->redirectToBillingPortal(route('public.payment.create'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $this->customer = $request->user();
        dd($this->customer->paymentMethods());
        // get stripeSource: src_1HwHNSBFmNHaPuJ064dItqEt

        return view('public.payment.index', compact('payment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
