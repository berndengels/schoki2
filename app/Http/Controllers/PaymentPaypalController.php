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

class PaymentPaypalController extends Controller
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
    public function index( Cart $cart )
    {
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
