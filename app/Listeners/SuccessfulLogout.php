<?php
namespace App\Listeners;

use App\Models\Shoppingcart;
use Illuminate\Auth\Events\Logout;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class SuccessfulLogout
{
    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        if('web' === $event->guard) {
            if(Session::has('scart')) {
                Cart::destroy();
                $sid = Session::get('scart');
                Shoppingcart::destroy($sid);
                Session::remove('scart');
            }
        }
    }
}
