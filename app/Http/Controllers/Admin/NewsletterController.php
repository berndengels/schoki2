<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Newsletter\BulkDestroyNewsletter;
use App\Http\Requests\Admin\Newsletter\DestroyNewsletter;
use App\Http\Requests\Admin\Newsletter\IndexNewsletter;
use App\Http\Requests\Admin\Newsletter\StoreNewsletter;
use App\Http\Requests\Admin\Newsletter\UpdateNewsletter;
use App\Models\Newsletter;
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

class NewsletterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexNewsletter $request
     * @return array|Factory|View
     */
    public function index(IndexNewsletter $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Newsletter::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'tag_id', 'created_by', 'updated_by'],

            // set columns to searchIn
            ['id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.newsletter.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.newsletter.create');

        return view('admin.newsletter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsletter $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreNewsletter $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Newsletter
        $newsletter = Newsletter::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/newsletters'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/newsletters');
    }

    /**
     * Display the specified resource.
     *
     * @param Newsletter $newsletter
     * @throws AuthorizationException
     * @return void
     */
    public function show(Newsletter $newsletter)
    {
        $this->authorize('admin.newsletter.show', $newsletter);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Newsletter $newsletter
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Newsletter $newsletter)
    {
        $this->authorize('admin.newsletter.edit', $newsletter);


        return view('admin.newsletter.edit', [
            'newsletter' => $newsletter,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNewsletter $request
     * @param Newsletter $newsletter
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateNewsletter $request, Newsletter $newsletter)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Newsletter
        $newsletter->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/newsletters'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/newsletters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyNewsletter $request
     * @param Newsletter $newsletter
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyNewsletter $request, Newsletter $newsletter)
    {
        $newsletter->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyNewsletter $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyNewsletter $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Newsletter::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
