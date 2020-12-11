<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Shipping;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShippingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function ViewAnyShipping(Customer $customer)
    {
        return $customer->hasRole('Customer') && Shipping::whereCustomerId($customer->id)->get()->count() > 0;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Shipping  $shipping
     * @return mixed
     */
    public function viewShipping(Customer $customer, Shipping $shipping)
    {
        return $customer->id === $shipping->customer_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function createShipping(Customer $customer)
    {
        return $customer->hasRole('Customer');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Shipping  $shipping
     * @return mixed
     */
    public function updateShipping(Customer $customer, Shipping $shipping)
    {
        return $customer->id === $shipping->customer_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Shipping  $shipping
     * @return mixed
     */
    public function deleteShipping(Customer $customer, Shipping $shipping)
    {
        return $customer->id === $shipping->customer_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Shipping  $shipping
     * @return mixed
     */
    public function restoreShipping(Customer $customer, Shipping $shipping)
    {
        return $customer->id === $shipping->customer_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Shipping  $shipping
     * @return mixed
     */
    public function forceDeleteShipping(Customer $customer, Shipping $shipping)
    {
        return $customer->id === $shipping->customer_id;
    }
}
