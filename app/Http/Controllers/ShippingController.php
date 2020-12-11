<?php

namespace App\Http\Controllers;

use App\Helper\MyLang;
use App\Http\Requests\Admin\Shipping\UpdateShipping;
use App\Http\Requests\ShippingRequest;
use App\Models\Country;
use App\Models\Shipping;
use App\Forms\ShippingForm;
use App\Http\Requests\Admin\Shipping\StoreShipping;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ShippingController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = auth('web')->user();
        $data = Shipping::whereCustomerId($customer->id)->get();
        return view('public.shipping.index', compact( 'data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
/*
    public function create(FormBuilder $formBuilder)
    {
        $user       = auth('web')->user();
        $language   = MyLang::getPrimary();
        $country    = Country::whereCode(strtoupper($language))->first();

        $form   = $formBuilder->create(ShippingForm::class, [], [
            'user'      => $user,
            'shipping'  => null,
            'language'  => $language,
            'country'   => $country,
        ]);

        return view('public.form.shipping', compact('form'));
    }
*/
    public function create()
    {
        $language   = MyLang::getPrimary();
        $countries  = Country::all()->sortBy($language);
        $country    = $countries->where('code', strtoupper($language))->first();
        $data       = null;
        return view('public.shipping.create', compact('data','country', 'language', 'countries'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreShipping  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShipping $request )
    {
        $validated = $request->getSanitized();
        $shipping = Shipping::create($validated);
        if($shipping->is_default) {
            Shipping::whereKeyNot($shipping->id)->update(['is_default' => false]);
        }
        return redirect()->route('shipping.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(FormBuilder $formBuilder, Shipping $shipping)
    {
        $language   = MyLang::getPrimary();
        $countries  = Country::all()->sortBy($language);
//        $country    = Country::whereCode(strtoupper($language))->first();
        $country    = $shipping->country_id;
        $data       = $shipping;
        return view('public.shipping.edit', compact('data','country', 'language', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateShipping  $request
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShipping $request, Shipping $shipping)
    {
        $validated = $request->getSanitized();
        $shipping->update($validated);
        if($shipping->is_default) {
            Shipping::whereKeyNot($shipping->id)->update(['is_default' => false]);
        }
        return redirect()->route('shipping.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        //
    }
}
