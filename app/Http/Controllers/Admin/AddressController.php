<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AddressExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Address\BulkDestroyAddress;
use App\Http\Requests\Admin\Address\DestroyAddress;
use App\Http\Requests\Admin\Address\IndexAddress;
use App\Http\Requests\Admin\Address\StoreAddress;
use App\Http\Requests\Admin\Address\UpdateAddress;
use App\Models\Address;
use App\Models\AddressCategory;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\View\View;

class AddressController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexAddress $request
     * @return array|Factory|View
     */
    public function index(IndexAddress $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Address::class)->processRequestAndGet(
            // pass the request with params
            $request,
            // set columns to query
            ['id', 'address_category_id', 'email', 'token', 'info_on_changes'],
            // set columns to searchIn
            ['id', 'email', 'token'],
            function (Builder $query) use ($request) {
                $query->with('addressCategory');
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

        return view('admin.address.index', [
            'data' => $data,
            'addressCategories' => AddressCategory::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.address.create');

        return view('admin.address.create', [
            'addressCategories' => AddressCategory::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAddress $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreAddress $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Address
        $address = Address::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/addresses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/addresses');
    }

    /**
     * Display the specified resource.
     *
     * @param Address $address
     * @throws AuthorizationException
     * @return void
     */
    public function show(Address $address)
    {
        $this->authorize('admin.address.show', $address);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Address $address
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Address $address)
    {
        $this->authorize('admin.address.edit', $address);


        return view('admin.address.edit', [
            'address' => $address,
            'addressCategories' => AddressCategory::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAddress $request
     * @param Address $address
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateAddress $request, Address $address)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Address
        $address->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/addresses'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/addresses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyAddress $request
     * @param Address $address
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyAddress $request, Address $address)
    {
        $address->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyAddress $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyAddress $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Address::whereIn('id', $bulkChunk)->delete();

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
        return Excel::download(app(AddressExport::class), 'addresses.xlsx');
    }
}
