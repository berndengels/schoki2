<?php
namespace App\Http\Controllers;

use App\Models\Product;
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
    public function index(Cart $cart)
    {
//        dd($cart->content());
        $data = Product::all()->map(function (Product $product) use ($cart) {
            $product->thumb = null;
            $product->added = $cart->count();
            if( $product->getThumbs200ForCollection('product_images')->count() ) {
                $product->thumb = $product->getThumbs200ForCollection('product_images')->first()['thumb_url'];
            }
            $product->cartItem = $product->getCartItem($cart);
            return $product;
        });
        return view('public.product.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product, Cart $cart)
    {
        $product->images = null;
        $product->added = null;
        if($product->hasMedia('product_images')) {
            $images = $product->getMedia('product_images')->map(function($i) {
                return $i->getUrl();
            });
            $product->images = $images;
        }

        $cartItem = $cart->search(function($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->getBuyableIdentifier();
        })->first();
//        dd($cartItem->qty);
        return view('public.product.show', compact('product','cartItem'));
    }
}
