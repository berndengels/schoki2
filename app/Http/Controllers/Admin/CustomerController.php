<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Exception;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\BulkDestroyCustomer;
use App\Http\Requests\Admin\Customer\DestroyCustomer;
use App\Http\Requests\Admin\Customer\IndexCustomer;
use App\Http\Requests\Admin\Customer\StoreCustomer;
use App\Http\Requests\Admin\Customer\UpdateCustomer;
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

class CustomerController extends Controller
{
    /**
     * Guard used for admin user
     *
     * @var string
     */
    protected $guard = 'web';

    public function __construct()
    {
//        $this->middleware('customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexCustomer $request
     * @return array|Factory|View
     */
    public function index(IndexCustomer $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Customer::class)->processRequestAndGet(
            // pass the request with params
            $request,
            // set columns to query
            ['id', 'name', 'email', 'email_verified_at', 'stripe_id', 'card_brand', 'card_last_four', 'trial_ends_at'],
            // set columns to searchIn
            ['id', 'name', 'email', 'stripe_id', 'card_brand', 'card_last_four'],
            function (Builder $query) {
                $query->with('shippings','roles','permissions');
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
        return view('admin.customer.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('customer.write');

        return view('admin.customer.create', [
            'roles' => Role::where('guard_name', $this->guard)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCustomer $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCustomer $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Customer
        $customer = Customer::create($sanitized);

        if ($request->input('roles')) {
            $customer->roles()->sync(collect($request->input('roles', []))->map->id->toArray());
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/customers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @throws AuthorizationException
     * @return void
     */
    public function show(Customer $customer)
    {
        $this->authorize('customer', $customer);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Customer $customer)
    {
        $this->authorize('customer.write', $customer);
        $customer->load(['roles']);

        return view('admin.customer.edit', [
            'roles'     => Role::where('guard_name', $this->guard)->get(),
            'customer'  => $customer,
            'shippings' => $customer->shippings,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCustomer $request
     * @param Customer $customer
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCustomer $request, Customer $customer)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Customer
        $customer->update($sanitized);

        if ($request->input('roles')) {
            $customer->roles()->sync(collect($request->input('roles', []))->map->id->toArray());
        }
        if ($request->input('shippings')) {
            $customer->shippings()->sync($request->input('shippings')->map->id->toArray());
        }

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/customers'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCustomer $request
     * @param Customer $customer
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCustomer $request, Customer $customer)
    {
        $customer->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCustomer $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCustomer $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Customer::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
