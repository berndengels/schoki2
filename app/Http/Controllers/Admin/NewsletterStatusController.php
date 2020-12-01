<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsletterStatus\BulkDestroyNewsletterStatus;
use App\Http\Requests\Admin\NewsletterStatus\DestroyNewsletterStatus;
use App\Http\Requests\Admin\NewsletterStatus\IndexNewsletterStatus;
use App\Http\Requests\Admin\NewsletterStatus\StoreNewsletterStatus;
use App\Http\Requests\Admin\NewsletterStatus\UpdateNewsletterStatus;
use App\Models\NewsletterStatus;
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

class NewsletterStatusController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexNewsletterStatus $request
     * @return array|Factory|View
     */
    public function index(IndexNewsletterStatus $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(NewsletterStatus::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.newsletter-status.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.newsletter-status.create');

        return view('admin.newsletter-status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsletterStatus $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreNewsletterStatus $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the NewsletterStatus
        $newsletterStatus = NewsletterStatus::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/newsletter-statuses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/newsletter-statuses');
    }

    /**
     * Display the specified resource.
     *
     * @param NewsletterStatus $newsletterStatus
     * @throws AuthorizationException
     * @return void
     */
    public function show(NewsletterStatus $newsletterStatus)
    {
        $this->authorize('admin.newsletter-status.show', $newsletterStatus);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param NewsletterStatus $newsletterStatus
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(NewsletterStatus $newsletterStatus)
    {
        $this->authorize('admin.newsletter-status.edit', $newsletterStatus);


        return view('admin.newsletter-status.edit', [
            'newsletterStatus' => $newsletterStatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNewsletterStatus $request
     * @param NewsletterStatus $newsletterStatus
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateNewsletterStatus $request, NewsletterStatus $newsletterStatus)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values NewsletterStatus
        $newsletterStatus->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/newsletter-statuses'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/newsletter-statuses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyNewsletterStatus $request
     * @param NewsletterStatus $newsletterStatus
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyNewsletterStatus $request, NewsletterStatus $newsletterStatus)
    {
        $newsletterStatus->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyNewsletterStatus $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyNewsletterStatus $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    NewsletterStatus::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
