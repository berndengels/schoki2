<?php
namespace App\Http\Controllers;

use App\Http\Resources\Payment\Stripe\PortoPrice;
use App\Models\Scard;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ScardRequest;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request\Session;

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
        $porto = PortoPrice::getPrice($cart);
        return view('public.scard.index', compact('cart','content', 'porto'));
    }

    public function add(Request $request, Product $product, Cart $cart)
    {
        if($request->input('size')) {
            $product->size = $request->input('size');
        }
        $cart->add($product, 1)->options = ['size' => $request->input('size')];
        return redirect()->back();
    }

    public function increment(Cart $cart, $rawId)
    {
        $cart->update($rawId, $cart->get($rawId)->qty + 1);
        return redirect()->back();
    }

    public function decrement(Cart $cart, $rawId)
    {
        $cart->update($rawId, $cart->get($rawId)->qty - 1);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cart  $cart
     * @return Response
     */
    public function delete(Cart $cart, $rawId)
    {
        $cart->remove($rawId);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cart  $cart
     * @return Response
     */
    public function destroy(Cart $cart)
    {
        $cart->destroy();
        return redirect()->route('public.events');
    }
}
