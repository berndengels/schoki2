<?php

namespace App\Http\Controllers;

use App\Events\ProductOrdered;
use App\Helper\MyMoney;
use App\Http\Requests\CustomerRequest;
use App\Models\Order;
use App\Models\Shoppingcart;
use App\Models\Customer;
use App\Repositories\ShopRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\OrderRequest;
use Gloudemans\Shoppingcart\Cart;
use Laravel\Cashier\Cashier;

class OrderController extends Controller
{
    public function index(Cart $cart) {
        $this->middleware('auth');
        /**
         * @var Customer $customer
         */
        $customer = auth('web')->user();
        $order = ShopRepository::createOrderByCart($customer, $cart);

        $shippings = $customer->shippings;
        if(!$shippings->count() > 0) {
            return redirect()->route('shipping.create', ['redirectTo' => 'public.order.index'])
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
