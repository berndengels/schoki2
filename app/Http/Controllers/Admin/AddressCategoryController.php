<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddressCategory\BulkDestroyAddressCategory;
use App\Http\Requests\Admin\AddressCategory\DestroyAddressCategory;
use App\Http\Requests\Admin\AddressCategory\IndexAddressCategory;
use App\Http\Requests\Admin\AddressCategory\StoreAddressCategory;
use App\Http\Requests\Admin\AddressCategory\UpdateAddressCategory;
use App\Models\AddressCategory;
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

class AddressCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexAddressCategory $request
     * @return array|Factory|View
     */
    public function index(IndexAddressCategory $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(AddressCategory::class)->processRequestAndGet(
            // pass the request with params
            $request,
            // set columns to query
            ['id', 'tag_id', 'name'],
            // set columns to searchIn
            ['id', 'name'],
            function (Builder $query) use ($request) {
                $query->withCount('addresses');
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

        return view('admin.address-category.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.address-category.create');

        return view('admin.address-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAddressCategory $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreAddressCategory $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the AddressCategory
        $addressCategory = AddressCategory::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/address-categories'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/address-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param AddressCategory $addressCategory
     * @throws AuthorizationException
     * @return void
     */
    public function show(AddressCategory $addressCategory)
    {
        $this->authorize('admin.address-category.show', $addressCategory);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AddressCategory $addressCategory
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(AddressCategory $addressCategory)
    {
        $this->authorize('admin.address-category.edit', $addressCategory);


        return view('admin.address-category.edit', [
            'addressCategory' => $addressCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAddressCategory $request
     * @param AddressCategory $addressCategory
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateAddressCategory $request, AddressCategory $addressCategory)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values AddressCategory
        $addressCategory->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/address-categories'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/address-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyAddressCategory $request
     * @param AddressCategory $addressCategory
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyAddressCategory $request, AddressCategory $addressCategory)
    {
        $addressCategory->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyAddressCategory $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyAddressCategory $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    AddressCategory::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
