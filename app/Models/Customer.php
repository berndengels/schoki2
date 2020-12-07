<?php
namespace App\Models;

use Brackets\AdminAuth\Activation\Traits\CanActivate;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Support\Carbon;
use Laravel\Cashier\Subscription;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $stripe_id
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property Carbon|null $trial_ends_at
 * @property-read mixed $discount_rate
 * @property-read mixed $resource_url
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|Customer newModelQuery()
 * @method static Builder|Customer newQuery()
 * @method static Builder|Customer query()
 * @method static Builder|Customer whereCardBrand($value)
 * @method static Builder|Customer whereCardLastFour($value)
 * @method static Builder|Customer whereCreatedAt($value)
 * @method static Builder|Customer whereEmail($value)
 * @method static Builder|Customer whereEmailVerifiedAt($value)
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer whereName($value)
 * @method static Builder|Customer wherePassword($value)
 * @method static Builder|Customer whereRememberToken($value)
 * @method static Builder|Customer whereStripeId($value)
 * @method static Builder|Customer whereTrialEndsAt($value)
 * @method static Builder|Customer whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Collection|Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 */
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
