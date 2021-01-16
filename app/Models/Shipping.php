<?php

namespace App\Models;

use App\Models\Customer;
use Eloquent;
use Illuminate\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Shipping
 *
 * @property int $id
 * @property int $customer_id
 * @property int $country_id
 * @property string $postcode
 * @property string $city
 * @property string $street
 * @property int $is_default
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Country $country
 * @property-read Customer $customer
 * @property-read mixed $name
 * @property-read mixed $resource_url
 * @method static Builder|Shipping newModelQuery()
 * @method static Builder|Shipping newQuery()
 * @method static Builder|Shipping query()
 * @method static Builder|Shipping whereCity($value)
 * @method static Builder|Shipping whereCountryId($value)
 * @method static Builder|Shipping whereCreatedAt($value)
 * @method static Builder|Shipping whereCustomerId($value)
 * @method static Builder|Shipping whereId($value)
 * @method static Builder|Shipping whereIsDefault($value)
 * @method static Builder|Shipping wherePostcode($value)
 * @method static Builder|Shipping whereStreet($value)
 * @method static Builder|Shipping whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Shipping extends Model
{
    protected $table = 'shipping';
    protected $appends = ['resource_url','name'];
    protected $fillable = [
        'customer_id',
        'country_id',
        'postcode',
        'city',
        'street',
        'is_default',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/shippings/'.$this->getKey());
    }

    public function getNameAttribute()
    {
        return "$this->postcode $this->city, $this->street";
    }

    public function __toString()
    {
        return $this->name;
    }
}
