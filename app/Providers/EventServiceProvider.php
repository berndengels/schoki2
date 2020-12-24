<?php
namespace App\Providers;

use App\Events\ProductOrdered;
use App\Events\PaymentSucceeded;
use App\Listeners\OrderNotification;
use App\Listeners\PaymentNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Logout;
use App\Listeners\SuccessfulLogout;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [SendEmailVerificationNotification::class],
        PaymentSucceeded::class => [PaymentNotification::class],
        ProductOrdered::class => [OrderNotification::class],
        Logout::class => [SuccessfulLogout::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
