<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBySize;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Cart $cart, $activeSize = null)
    {
        $data = Product::with('sizes')->get()->map(function (Product $product) use ($cart, $activeSize) {
            $product->thumb = null;
            $product->added = $cart->count();
            if ($product->getThumbs200ForCollection('product_images')->count()) {
                $product->thumb = $product->getThumbs200ForCollection('product_images')->first()['thumb_url'];
            }
            $product->cartItems = $product->getCartItems($cart);
            if($activeSize) {
                $activeCartItem = $cart->content()->firstWhere('id', $product->id.'-'.$activeSize);
            } else {
                $activeCartItem = null;
            }
            $product->activeCartItem = $activeCartItem;
            return $product;
        });
        return view('public.product.index', compact('data','activeSize'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product, Cart $cart, $activeSize = null)
    {
        $product->images = null;
        $product->added = null;
        if ($product->hasMedia('product_images')) {
            $images = $product->getMedia('product_images')->map(function ($i) {
                return $i->getUrl();
            });
            $product->images = $images;
        }
        $product->load('stocks');

        $cartItem = $cart->search(function ($cartItem, $rowId) use ($product, $activeSize) {
            return $cartItem->id === $activeSize ? $product->id.'-'.$activeSize : $product->id;
        })->first();

        if($activeSize) {
            $activeCartItem = $cart->content()->firstWhere('id', $product->id.'-'.$activeSize);
        } else {
            $activeCartItem = null;
        }
        $product->activeCartItem = $activeCartItem;

        return view('public.product.show', compact('product', 'cartItem', 'activeSize'));
    }
}
