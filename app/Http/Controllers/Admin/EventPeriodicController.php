<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EventPeriodicExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventPeriodic\BulkDestroyEventPeriodic;
use App\Http\Requests\Admin\EventPeriodic\DestroyEventPeriodic;
use App\Http\Requests\Admin\EventPeriodic\IndexEventPeriodic;
use App\Http\Requests\Admin\EventPeriodic\StoreEventPeriodic;
use App\Http\Requests\Admin\EventPeriodic\UpdateEventPeriodic;
use App\Models\Category;
use App\Models\EventPeriodic;
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

class EventPeriodicController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexEventPeriodic $request
     * @return array|Factory|View
     */
    public function index(IndexEventPeriodic $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(EventPeriodic::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            [
                'id',
                'theme_id',
                'category_id',
                'title',
                'event_time',
                'periodic_position',
                'periodic_weekday',
                'is_published',
                'created_by',
                'updated_by'
            ],

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

        return view('admin.event-periodic.index', [
            'data' => $data
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
        $this->authorize('event-periodic.create');

        return view('admin.event-periodic.create', [
            'categories'    => Category::all(['id', 'name']),
            'themes'        => Theme::all(['id', 'name']),
            'periodicPositions' => collect(config('my.periodicPositions')),
            'periodicWeekdays' => collect(config('my.periodicWeekdays')),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventPeriodic $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreEventPeriodic $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the EventPeriodic
        $eventPeriodic = EventPeriodic::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/event-periodics'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/event-periodics');
    }

    /**
     * Display the specified resource.
     *
     * @param EventPeriodic $eventPeriodic
     * @throws AuthorizationException
     * @return void
     */
    public function show(EventPeriodic $eventPeriodic)
    {
        $this->authorize('event-periodic.show', $eventPeriodic);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EventPeriodic $eventPeriodic
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(EventPeriodic $eventPeriodic)
    {
        $this->authorize('event-periodic.edit', $eventPeriodic);
        return view('admin.event-periodic.edit', [
            'eventPeriodic' => $eventPeriodic,
            'categories'    => Category::all(['id', 'name']),
            'themes'        => Theme::all(['id', 'name']),
            'periodicPositions' => collect(config('my.periodicPositions')),
            'periodicWeekdays' => collect(config('my.periodicWeekdays')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventPeriodic $request
     * @param EventPeriodic $eventPeriodic
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateEventPeriodic $request, EventPeriodic $eventPeriodic)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values EventPeriodic
        $eventPeriodic->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/event-periodics'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/event-periodics');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyEventPeriodic $request
     * @param EventPeriodic $eventPeriodic
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyEventPeriodic $request, EventPeriodic $eventPeriodic)
    {
        $eventPeriodic->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyEventPeriodic $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyEventPeriodic $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    EventPeriodic::whereIn('id', $bulkChunk)->delete();

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
        return Excel::download(app(EventPeriodicExport::class), 'eventPeriodics.xlsx');
    }
}
