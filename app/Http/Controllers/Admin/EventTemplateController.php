<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EventTemplateExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventTemplate\BulkDestroyEventTemplate;
use App\Http\Requests\Admin\EventTemplate\DestroyEventTemplate;
use App\Http\Requests\Admin\EventTemplate\IndexEventTemplate;
use App\Http\Requests\Admin\EventTemplate\StoreEventTemplate;
use App\Http\Requests\Admin\EventTemplate\UpdateEventTemplate;
use App\Models\Category;
use App\Models\EventTemplate;
use App\Models\Theme;
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

class EventTemplateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexEventTemplate $request
     * @return array|Factory|View
     */
    public function index(IndexEventTemplate $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(EventTemplate::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'theme_id', 'category_id', 'title', 'created_by', 'updated_by'],

            // set columns to searchIn
            ['id', 'title', 'description'],
            function (Builder $query) use ($request) {
                $query->with(['category','theme','createdBy','updatedBy']);
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

        return view('admin.event-template.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('event-template.create');

        return view('admin.event-template.create', [
            'categories'    => Category::all(['id', 'name']),
            'themes'        => Theme::all(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventTemplate $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreEventTemplate $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the EventTemplate
        $eventTemplate = EventTemplate::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/event-templates'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/event-templates');
    }

    /**
     * Display the specified resource.
     *
     * @param EventTemplate $eventTemplate
     * @throws AuthorizationException
     * @return void
     */
    public function show(EventTemplate $eventTemplate)
    {
        $this->authorize('event-template.show', $eventTemplate);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EventTemplate $eventTemplate
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(EventTemplate $eventTemplate)
    {
        $this->authorize('event-template.edit', $eventTemplate);

        return view('admin.event-template.edit', [
            'eventTemplate' => $eventTemplate,
            'categories'    => Category::all(['id', 'name']),
            'themes'        => Theme::all(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventTemplate $request
     * @param EventTemplate $eventTemplate
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateEventTemplate $request, EventTemplate $eventTemplate)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values EventTemplate
        $eventTemplate->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/event-templates'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/event-templates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyEventTemplate $request
     * @param EventTemplate $eventTemplate
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyEventTemplate $request, EventTemplate $eventTemplate)
    {
        $eventTemplate->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyEventTemplate $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyEventTemplate $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    EventTemplate::whereIn('id', $bulkChunk)->delete();

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
        return Excel::download(app(EventTemplateExport::class), 'eventTemplates.xlsx');
    }
}
