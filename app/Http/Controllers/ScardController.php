<?php
namespace App\Http\Controllers;

use App\Models\Scard;
use App\Models\Product;
use Illuminate\Http\Response;
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
//        $cart->destroy();
        return view('public.scard.index', compact('cart'));
    }

    public function add(Product $product, Cart $cart)
    {
        $cart->add($product, 1);
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
     * @param  int  $id
     * @return Response
     */
    public function destroy(Cart $cart, $rawId)
    {
        $cart->remove($rawId);
        return redirect()->back();
    }
}
