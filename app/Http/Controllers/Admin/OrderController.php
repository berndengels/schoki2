<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Traits\PDFAddress;
use App\Models\Shipping;
use Exception;
use App\Models\Order;
use App\Models\Customer;
use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\BulkDestroyOrder;
use App\Http\Requests\Admin\Order\DestroyOrder;
use App\Http\Requests\Admin\Order\IndexOrder;
use App\Http\Requests\Admin\Order\StoreOrder;
use App\Http\Requests\Admin\Order\UpdateOrder;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    use PDFAddress;
    /**
     * Display a listing of the resource.
     *
     * @param IndexOrder $request
     * @return array|Factory|View
     */
    public function index(IndexOrder $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Order::class)->processRequestAndGet(
            // pass the request with params
            $request,
            // set columns to query
            ['id', 'created_at','amount_received', 'created_by', 'paid_on', 'delivered_on'],
            // set columns to searchIn
            ['id', 'created_by'],
            function (Builder $query) {
                $query->orderBy('created_at','DESC');
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

        return view('admin.order.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.order.create');
        return view('admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrder $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreOrder $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        // Store the Order
        Order::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/orders'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/orders');
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @throws AuthorizationException
     * @return void
     */
    public function show(Order $order)
    {
        $this->authorize('admin.order.show', $order);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param Shipping $shipping
     * @throws AuthorizationException
     * @return void
     */
    public function print(Order $order)
    {
        $this->authorize('admin.order.show', $order);
        return self::download($order->createdBy->shipping);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Order $order)
    {
        $this->authorize('admin.order.edit', $order);
        return view('admin.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrder $request
     * @param Order $order
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateOrder $request, Order $order)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        // Update changed values Order
        $order->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/orders'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyOrder $request
     * @param Order $order
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyOrder $request, Order $order)
    {
        $order->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyOrder $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyOrder $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Order::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    /**
     * Export entities
     *
     * @return BinaryFileResponse|null
     */
    public function export(): ?BinaryFileResponse
    {
        return Excel::download(app(OrderExport::class), 'orders.xlsx');
    }
}
