<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ThemeExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Theme\BulkDestroyTheme;
use App\Http\Requests\Admin\Theme\DestroyTheme;
use App\Http\Requests\Admin\Theme\IndexTheme;
use App\Http\Requests\Admin\Theme\StoreTheme;
use App\Http\Requests\Admin\Theme\UpdateTheme;
use App\Models\Theme;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\View\View;

class ThemeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTheme $request
     * @return array|Factory|View
     */
    public function index(IndexTheme $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Theme::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'icon'],

            // set columns to searchIn
            ['id', 'name', 'icon']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.theme.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('theme.create');

        return view('admin.theme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTheme $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTheme $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Theme
        $theme = Theme::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/themes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/themes');
    }

    /**
     * Display the specified resource.
     *
     * @param Theme $theme
     * @throws AuthorizationException
     * @return void
     */
    public function show(Theme $theme)
    {
        $this->authorize('theme.show', $theme);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Theme $theme
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Theme $theme)
    {
        $this->authorize('theme.edit', $theme);


        return view('admin.theme.edit', [
            'theme' => $theme,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTheme $request
     * @param Theme $theme
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTheme $request, Theme $theme)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Theme
        $theme->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/themes'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/themes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTheme $request
     * @param Theme $theme
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTheme $request, Theme $theme)
    {
        $theme->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTheme $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTheme $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Theme::whereIn('id', $bulkChunk)->delete();

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
        return Excel::download(app(ThemeExport::class), 'themes.xlsx');
    }
}
