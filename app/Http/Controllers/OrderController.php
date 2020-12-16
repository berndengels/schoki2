<?php

namespace App\Http\Controllers;

use App\Events\ProductOrdered;
use App\Helper\MyMoney;
use App\Http\Requests\CustomerRequest;
use App\Models\Order;
use App\Models\Shoppingcart;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\OrderRequest;
use Gloudemans\Shoppingcart\Cart;

class OrderController extends Controller
{
    public function __contsruct() {
    }

    public function index(Cart $cart) {
        $this->middleware('auth');
        /**
         * @var Customer $customer
         */
        $customer = auth('web')->user();
        $shippings = $customer->shippings;
        if(!$shippings->count() > 0) {
            return redirect()->route('shipping.create')
                ->with(['ordering' => true, 'customer' => $customer]);
        }
        $shippingDefault = $shippings->where('is_default', true)->first();

        $content = null;
        if($cart->content()->count()) {
            $content = $cart->content();
        }

        return view('public.order.index', compact('cart','content', 'customer', 'shippings', 'shippingDefault'));
    }
}
