<?php
namespace App\Http\Controllers;

use App\Helper\MyMoney;
use App\Models\Customer;
use App\Models\Scard;
use App\Models\Product;
use App\Models\Shoppingcart;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\ScardRequest;
use Gloudemans\Shoppingcart\Cart;

/**
 * Class ScardController
 * @package App\Http\Controllers
 * @todo: remove obsolete shopping cart entries
 */
class ScardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Cart $cart)
    {
        $content = null;
        if($cart->content()->count()) {
            $content = $cart->content();
        }
        return view('public.scard.index', compact('cart','content'));
    }

    public function add(Request $request, Product $product, Cart $cart)
    {
        /**
         * @var CartItem $item
         * @var Customer $customer
         */
        $customer = $request->user('web');
        $cart->add($product, 1);
        if(Shoppingcart::whereIdentifier($customer->getInstanceIdentifier())->first()) {
            $cart->restore($customer->getInstanceIdentifier());
        } else {
            $cart->store($customer->getInstanceIdentifier());
        }

        return redirect()->back();
    }

    public function increment(Request $request, Cart $cart, $rawId)
    {
        /**
         * @var CartItem $item
         * @var Customer $customer
         */
        $customer = $request->user('web');
        $cart->update($rawId, $cart->get($rawId)->qty + 1);
        $cart->restore($customer->getInstanceIdentifier());
        return redirect()->back();
    }

    public function decrement(Request $request, Cart $cart, $rawId)
    {
        /**
         * @var CartItem $item
         * @var Customer $customer
         */
        $customer = $request->user('web');
        $cart->update($rawId, $cart->get($rawId)->qty - 1);
        $cart->restore($customer->getInstanceIdentifier());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, Cart $cart)
    {
        /**
         * @var Customer $customer
         */
        $customer = $request->user('web');
        $cart->destroy();
        Shoppingcart::whereIdentifier($customer->getInstanceIdentifier())->delete();
        return redirect()->route('public.events');
    }
}
