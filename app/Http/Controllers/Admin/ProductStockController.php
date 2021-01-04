<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStock\BulkDestroyProductStock;
use App\Http\Requests\Admin\ProductStock\DestroyProductStock;
use App\Http\Requests\Admin\ProductStock\IndexProductStock;
use App\Http\Requests\Admin\ProductStock\StoreProductStock;
use App\Http\Requests\Admin\ProductStock\UpdateProductStock;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductStock;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductStockController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexProductStock $request
     * @return array|Factory|View
     */
    public function index(IndexProductStock $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ProductStock::class)->processRequestAndGet(
            // pass the request with params
            $request,
            // set columns to query
            ['id', 'product_id', 'product_size_id', 'stock'],
            // set columns to searchIn
            ['id'],
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.product-stock.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('product-stock.create');
        $products   = Product::all(['id','name']);
        $sizes      = ProductSize::all(['id', 'name']);
        return view('admin.product-stock.create', compact('products', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductStock $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreProductStock $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        // Store the ProductStock
        ProductStock::create($sanitized);

        if ($request->ajax()) {
            return [
                'redirect'  => url('admin/product-stocks'),
                'message'   => trans('brackets/admin-ui::admin.operation.succeeded')
            ];
        }

        return redirect('admin/product-stocks');
    }

    /**
     * Display the specified resource.
     *
     * @param ProductStock $productStock
     * @throws AuthorizationException
     * @return void
     */
    public function show(ProductStock $productStock)
    {
        $this->authorize('product-stock.show', $productStock);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductStock $productStock
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(ProductStock $productStock)
    {
        $this->authorize('product-stock.edit', $productStock);
        $products   = Product::all(['id','name']);
        $sizes      = ProductSize::all(['id', 'name']);
        return view('admin.product-stock.edit', compact('productStock','products','sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductStock $request
     * @param ProductStock $productStock
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateProductStock $request, ProductStock $productStock)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        // Update changed values ProductStock
        $productStock->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/product-stocks'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/product-stocks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyProductStock $request
     * @param ProductStock $productStock
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyProductStock $request, ProductStock $productStock)
    {
        $productStock->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyProductStock $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyProductStock $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ProductStock::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
