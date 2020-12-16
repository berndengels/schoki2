<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Menu;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\BulkDestroyMenu;
use App\Http\Requests\Admin\Menu\DestroyMenu;
use App\Http\Requests\Admin\Menu\IndexMenu;
use App\Http\Requests\Admin\Menu\StoreMenu;
use App\Http\Requests\Admin\Menu\UpdateMenu;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MenuControllerOrig extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexMenu $request
     * @return array|Factory|View
     */
    public function index(IndexMenu $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Menu::class)->processRequestAndGet(
            // pass the request with params
            $request,
            // set columns to query
            ['id', 'parent_id', 'menu_item_type_id', 'name', 'url', 'lft', 'rgt', 'lvl', 'api_enabled', 'is_published'],
            // set columns to searchIn
            ['id', 'name', 'url'],
            function (Builder $query) use ($request) {
                $query->with(['parent','menuItemType']);
                if($request->has('parent')){
                    $query->where('parent_id', $request->get('parent'));
                }
                $query->orderBy('lft');
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

        return view('admin.menu.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.menu.create');

        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMenu $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMenu $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Menu
        $menu = Menu::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/menus'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/menus');
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     * @throws AuthorizationException
     * @return void
     */
    public function show(Menu $menu)
    {
        $this->authorize('admin.menu.show', $menu);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Menu $menu
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Menu $menu)
    {
        $this->authorize('admin.menu.edit', $menu);


        return view('admin.menu.edit', [
            'menu' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMenu $request
     * @param Menu $menu
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMenu $request, Menu $menu)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Menu
        $menu->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/menus'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/menus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyMenu $request
     * @param Menu $menu
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMenu $request, Menu $menu)
    {
        $menu->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyMenu $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMenu $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Menu::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
