<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Traits\PDFAddress;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Shipping\BulkDestroyShipping;
use App\Http\Requests\Admin\Shipping\DestroyShipping;
use App\Http\Requests\Admin\Shipping\IndexShipping;
use App\Http\Requests\Admin\Shipping\StoreShipping;
use App\Http\Requests\Admin\Shipping\UpdateShipping;
use App\Models\Shipping;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ShippingController extends Controller
{
    use PDFAddress;
    /**
     * Display a listing of the resource.
     *
     * @param IndexShipping $request
     * @return array|Factory|View
     */
    public function index(IndexShipping $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Shipping::class)->processRequestAndGet(
            // pass the request with params
            $request,
            // set columns to query
            ['id', 'customer_id', 'postcode', 'city', 'street', 'is_default'],
            // set columns to searchIn
            ['id', 'postcode', 'city', 'street'],
            function (Builder $query) {
                $query->with(['customer','country']);
            }

        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.shipping.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.shipping.create');

        return view('admin.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreShipping $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreShipping $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Shipping
        $shipping = Shipping::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/shippings'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/shippings');
    }

    /**
     * Display the specified resource.
     *
     * @param Shipping $shipping
     * @throws AuthorizationException
     * @return void
     */
    public function show(Shipping $shipping)
    {
        $this->authorize('admin.shipping.show', $shipping);
    }

    /**
     * Display the specified resource.
     *
     * @param Shipping $shipping
     * @throws AuthorizationException
     * @return void
     */
    public function print(Shipping $shipping)
    {
        $this->authorize('admin.shipping.show', $shipping);
        return self::download($shipping);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Shipping $shipping
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Shipping $shipping)
    {
        $this->authorize('admin.shipping.edit', $shipping);

        return view('admin.shipping.edit', [
            'shipping' => $shipping,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateShipping $request
     * @param Shipping $shipping
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateShipping $request, Shipping $shipping)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Shipping
        $shipping->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/shippings'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/shippings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyShipping $request
     * @param Shipping $shipping
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyShipping $request, Shipping $shipping)
    {
        $shipping->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyShipping $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyShipping $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Shipping::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
