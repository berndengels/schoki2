<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\BulkDestroyNews;
use App\Http\Requests\Admin\News\DestroyNews;
use App\Http\Requests\Admin\News\IndexNews;
use App\Http\Requests\Admin\News\StoreNews;
use App\Http\Requests\Admin\News\UpdateNews;
use App\Models\News;
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

class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexNews $request
     * @return array|Factory|View
     */
    public function index(IndexNews $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(News::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'end_date', 'title', 'created_by', 'updated_by', 'show_item', 'is_published'],

            // set columns to searchIn
            ['id', 'title', 'text']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.news.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.news.create');

        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNews $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreNews $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the News
        $news = News::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/news'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/news');
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @throws AuthorizationException
     * @return void
     */
    public function show(News $news)
    {
        $this->authorize('admin.news.show', $news);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(News $news)
    {
        $this->authorize('admin.news.edit', $news);


        return view('admin.news.edit', [
            'news' => $news,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNews $request
     * @param News $news
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateNews $request, News $news)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values News
        $news->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/news'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyNews $request
     * @param News $news
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyNews $request, News $news)
    {
        $news->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyNews $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyNews $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    News::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
