<?php
namespace App\Http\Controllers\Api\SPA;

use App\Models\ProductBySize;
use App\Models\ProductSize;
use App\Models\Scard;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ScardRequest;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request\Session;
use App\Http\Resources\CartItemResource;
use App\Http\Resources\Payment\Stripe\PortoPrice;

/**
 * Class ScardController
 * @package App\Http\Controllers
 * @todo: remove obsolete shopping cart entries
 */
class SpaScardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Cart $cart)
    {
        $content = null;
        if ($cart->content()->count()) {
            $content = $cart->content();
        }
        $porto = PortoPrice::getPrice($cart);
        $response = [
            'cartItems' => CartItemResource::collection($content),
            'porto'     => $porto,
        ];
        return response()->json($response);
    }

    public function add(Request $request, Product $product, Cart $cart)
    {
        $size = $request->input('size');

        if ($size) {
            $product->name .= " Size: $size";
            $cartItem = new CartItemResource($product, $size);
        } else {
            $cartItem = new CartItemResource($product);
        }

        $response = $cart->add($cartItem->toArray($request), 1)->options = [
            'product_id' => $product->id,
            'size'       => $size,
        ];
        return response()->json($response);
    }

    public function increment(Cart $cart, $rawId)
    {
        $response = $cart->update($rawId, $cart->get($rawId)->qty + 1);
        return response()->json($response);
    }

    public function decrement(Cart $cart, $rawId)
    {
        $response = $cart->update($rawId, $cart->get($rawId)->qty - 1);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cart  $cart
     * @return Response
     */
    public function delete(Cart $cart, $rawId)
    {
        $response = $cart->remove($rawId);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cart  $cart
     * @return Response
     */
    public function destroy(Cart $cart)
    {
        $response = $cart->destroy();
        return response()->json($response);
    }
}
