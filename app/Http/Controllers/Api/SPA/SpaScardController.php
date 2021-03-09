<?php
namespace App\Http\Controllers\Api\SPA;

use App\Http\Requests\ApiProductRequest;
use App\Http\Resources\SpaCartItemResource;
use App\Http\Resources\SpaCartResource;
use App\Models\Scard;
use App\Models\Product;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ScardRequest;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request\Session;
use App\Http\Resources\CartItemResource;
use App\Http\Resources\Payment\Stripe\PortoPrice;
use App\Http\Controllers\Controller;

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
            'cartItems' => CartItemResource::collection($content)->toArray(),
            'porto'     => $porto,
        ];
        return response()->json($response);
    }

    public function add(ApiProductRequest $request, Cart $cart)
    {
        $validated = $request->validated();
        $size = $validated['size'] ?? null;
        /**
         * @var $cartItem CartItem
         */
        $cartItem = $cart->add($validated);
        $cartItem->options = [
            'product_id' => $validated['id'],
            'size'       => $size,
        ];
        $result = [
            'cartItem'      => new SpaCartItemResource($cartItem),
            'content'       => $cart->content()->values(),
            'priceTotal'    => $cart->priceTotal(2),
            'subtotal'      => $cart->subtotal(2),
            'tax'           => $cart->tax(2),
        ];
//        $cart = new SpaCartResource($cart);
        return response()->json($result);
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
