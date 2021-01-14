<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Event;
use App\Models\Theme;
use App\Helper\MyDate;
use App\Models\Category;
use Illuminate\View\View;
use App\Exports\EventExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Event\BulkDestroyEvent;
use App\Http\Requests\Admin\Event\DestroyEvent;
use App\Http\Requests\Admin\Event\IndexEvent;
use App\Http\Requests\Admin\Event\StoreEvent;
use App\Http\Requests\Admin\Event\UpdateEvent;
use Brackets\AdminListing\Facades\AdminListing;
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

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexEvent $request
     * @return array|Factory|View
     */
    public function index(IndexEvent $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Event::class)->processRequestAndGet(
            // pass the request with params
            $request,
            // set columns to query
            [
                'id',
                'theme_id',
                'category_id',
                'title',
                'description',
                'event_date',
                'event_time',
                'is_published',
                'created_by',
                'updated_by',
            ],
            // set columns to searchIn
            ['id', 'title', 'description'],
            function (Builder $query) use ($request) {
                $query->with(['category','theme','createdBy','updatedBy']);
                if($request->has('category')){
                    $query->where('category_id', $request->get('category'));
                }
                if($request->has('theme')){
                    $query->where('theme_id', $request->get('theme'));
                }
                $query
                    ->whereDate('event_date','>=', MyDate::getUntilValidDate())
                    ->orderBy('event_date', 'DESC')
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

        return view('admin.event.index', [
            'data'          => $data,
            'categories'    => Category::all(['id', 'name']),
            'themes'        => Theme::all(['id', 'name']),
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
        $this->authorize('event.create');

        return view('admin.event.create', [
            'categories'    => Category::all(['id', 'name']),
            'themes'        => Theme::all(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEvent $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreEvent $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        // Store the Event
        $event = Event::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/events'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/events');
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @throws AuthorizationException
     * @return void
     */
    public function show(Event $event)
    {
        $this->authorize('event.show', $event);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Event $event)
    {
        $this->authorize('event.edit', $event);
        return view('admin.event.edit', [
            'event'         => $event,
            'categories'    => Category::all(['id', 'name']),
            'themes'        => Theme::all(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEvent $request
     * @param Event $event
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateEvent $request, Event $event)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        // Update changed values Event
        $event->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/events'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/events');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyEvent $request
     * @param Event $event
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyEvent $request, Event $event)
    {
        $event->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyEvent $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyEvent $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Event::whereIn('id', $bulkChunk)->delete();

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
        return Excel::download(app(EventExport::class), 'events.xlsx');
    }
}
