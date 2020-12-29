<?php
namespace App\Models;

use Eloquent;
use Laravel\Cashier\Billable;
use Illuminate\Support\Carbon;
use Laravel\Cashier\Subscription;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Gloudemans\Shoppingcart\Contracts\InstanceIdentifier;

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
 * @property-read mixed $shipping_list
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @property-read Collection|Shipping[] $shippings
 * @property-read int|null $shippings_count
 * @method static Builder|Customer permission($permissions)
 * @method static Builder|Customer role($roles, $guard = null)
 * @property-read mixed $shipping
 * @property-read Collection|Download[] $downloads
 * @property-read int|null $downloads_count
 */
class Customer extends Authenticatable implements InstanceIdentifier
{
    use HasFactory, Notifiable, Billable, HasRoles, HasPermissions, HasRoles;

    protected $table = 'customers';
    protected $appends = ['resource_url', 'discountRate', 'shippingList', 'shipping'];
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $guard_name = 'web';

    public function getInstanceIdentifier($options = null)
    {
        return $this->email;
    }

    public function getInstanceGlobalDiscount($options = null)
    {
        return 0;
    }

    public function getDiscountRateAttribute()
    {
        return 0;
    }

    public function getShippingAttribute()
    {
        return $this->shippings()->whereIsDefault(true)->first();
    }

    public function getShippingListAttribute() {
        if($this->shippings()->whereCustomerId($this->id)->count()) {
            return implode('<br>', $this->shippings->pluck('name')->toArray());
        }
        return null;
    }

    public function shippings()
    {
        return $this->hasMany(Shipping::class, 'customer_id', 'id');
    }

    public function downloads()
    {
        return $this->hasMany(Download::class, 'customer_id', 'id');
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/customers/'.$this->getKey());
    }

    public function __toString()
    {
        return $this->name;
    }
}
