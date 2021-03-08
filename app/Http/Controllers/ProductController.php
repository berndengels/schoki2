<?php
namespace App\Http\Controllers;

use App\Http\Resources\SpaProductCollection;
use App\Http\Resources\SpaProductResource;
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
    public function index(Request $request)
    {
        $data = Product::with('sizes')->get()->map(function (Product $product) {
            $product->thumb = null;
            if ($product->getThumbs200ForCollection('product_images')->count()) {
                $product->thumb = $product->getThumbs200ForCollection('product_images')->first()['thumb_url'];
            }
            return $product;
        });
        $data = $data->map(function ($item) use ($request) {
            return (new SpaProductResource($item))->toArray($request);
        })->toArray();
        return view('public.product.index', ['data' => $data]);

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
        if ($product->hasMedia('product_images')) {
            $images = $product->getMedia('product_images')->map(function ($i) {
                return $i->getUrl();
            });
            $product->images = $images;
        }
        $product->load('stocks');

        $product = (new SpaProductResource($product))->toJson();
        return view('public.product.show', compact('product'));
    }
}
