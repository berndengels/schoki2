<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MusicStyleExport;
use App\Helper\MyDate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MusicStyle\BulkDestroyMusicStyle;
use App\Http\Requests\Admin\MusicStyle\DestroyMusicStyle;
use App\Http\Requests\Admin\MusicStyle\IndexMusicStyle;
use App\Http\Requests\Admin\MusicStyle\StoreMusicStyle;
use App\Http\Requests\Admin\MusicStyle\UpdateMusicStyle;
use App\Models\MusicStyle;
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
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\View\View;

class MusicStyleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexMusicStyle $request
     * @return array|Factory|View
     */
    public function index(IndexMusicStyle $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(MusicStyle::class)->processRequestAndGet(
            // pass the request with params
            $request,
            // set columns to query
            ['id', 'name'],
            // set columns to searchIn
            ['id', 'name', 'slug'],
            function (Builder $query) use ($request) {
                $query
                    ->with('adminUsers')
                    ->orderBy('name')
                ;
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

        return view('admin.music-style.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.music-style.create');

        return view('admin.music-style.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMusicStyle $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMusicStyle $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the MusicStyle
        $musicStyle = MusicStyle::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/music-styles'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/music-styles');
    }

    /**
     * Display the specified resource.
     *
     * @param MusicStyle $musicStyle
     * @throws AuthorizationException
     * @return void
     */
    public function show(MusicStyle $musicStyle)
    {
        $this->authorize('admin.music-style.show', $musicStyle);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MusicStyle $musicStyle
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(MusicStyle $musicStyle)
    {
        $this->authorize('admin.music-style.edit', $musicStyle);


        return view('admin.music-style.edit', [
            'musicStyle' => $musicStyle,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMusicStyle $request
     * @param MusicStyle $musicStyle
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMusicStyle $request, MusicStyle $musicStyle)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values MusicStyle
        $musicStyle->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/music-styles'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/music-styles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyMusicStyle $request
     * @param MusicStyle $musicStyle
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMusicStyle $request, MusicStyle $musicStyle)
    {
        $musicStyle->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyMusicStyle $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMusicStyle $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    MusicStyle::whereIn('id', $bulkChunk)->delete();

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
        return Excel::download(app(MusicStyleExport::class), 'musicStyles.xlsx');
    }
}
