<?php
namespace App\Models;

use Brackets\AdminAuth\Activation\Traits\CanActivate;

class Customer extends User
{
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'stripe_id',
        'card_brand',
        'card_last_four',
        'trial_ends_at',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'trial_ends_at',
    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/customers/'.$this->getKey());
    }
}
