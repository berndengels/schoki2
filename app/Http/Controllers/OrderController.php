<?php

namespace App\Http\Controllers;

use App\Http\Resources\Payment\Stripe\PortoPrice;
use App\Models\Customer;
use Gloudemans\Shoppingcart\Cart;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function index(Cart $cart)
    {
        $this->middleware('auth');
        /**
         * @var Customer $customer
         */
        $customer   = auth('web')->user();
        $shippings  = $customer->shippings;
        if (!$shippings->count() > 0) {
            return redirect()->route('shipping.create', ['redirectTo' => 'public.order.index'])
                ->with(['ordering' => true, 'customer' => $customer]);
        }
        $shippingDefault = $shippings->where('is_default', true)->first();

        $content = null;
        if ($cart->content()->count()) {
            $content = $cart->content();
        }
        $porto = PortoPrice::getPrice($cart);

        return view('public.order.index', compact('cart', 'content', 'customer', 'shippings', 'shippingDefault', 'porto'));
    }
}
