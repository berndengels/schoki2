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
use Illuminate\Http\Response;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ShippingController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $customer = auth('web')->user();
        $data = Shipping::with('country')->whereCustomerId($customer->id)->get();
        return view('public.shipping.index', compact( 'data'));
    }

    /**
     * Display the specified resource.
     *
     * @param Shipping $shipping
     * @return Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $language   = MyLang::getPrimary();
        $countries  = Country::all()->sortBy($language);
        $country    = $countries->where('code', strtoupper($language))->first();
        $data       = null;
        $redirectTo = $request->has('redirectTo') ? $request->input('redirectTo') : null;
        return view('public.shipping.create', compact('data','country', 'language', 'countries' , 'redirectTo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreShipping  $request
     * @return Response
     */
    public function store(ShippingRequest $request )
    {
        $customer   = $request->user('web');
        $validated = $request->getSanitized();
        $shipping = Shipping::create($validated);
        $redirectTo = $request->input('redirectTo',null);

        if($shipping->is_default) {
            Shipping::whereKeyNot($shipping->id)->update(['is_default' => false]);
        } else {
            if(Shipping::whereCustomerId($customer->id)->count()) {
                $shipping->update(['is_default' => true]);
            }
        }

        if($redirectTo) {
            return redirect()->route($redirectTo);
        } else {
            return redirect()->route('shipping.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Shipping $shipping
     * @return Response
     */
    public function edit(Shipping $shipping)
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
     * @param Shipping $shipping
     * @return Response
     */
    public function update(ShippingRequest $request, Shipping $shipping)
    {
        $customer   = $request->user('web');
        $validated  = $request->getSanitized();
        $shipping->update($validated);
        if($shipping->is_default) {
            Shipping::whereKeyNot($shipping->id)->update(['is_default' => false]);
        } else {
            if(1 === Shipping::whereCustomerId($customer->id)->count()) {
                $shipping->update(['is_default' => true]);
            }
        }
        return redirect()->route('shipping.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Shipping $shipping
     * @return Response
     */
    public function destroy(Shipping $shipping)
    {
        //
    }
}
