<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Address
 *
 * @property int $id
 * @property int $address_category_id
 * @property string $email
 * @property string $token
 * @property int $info_on_changes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $resource_url
 * @method static Builder|Address newModelQuery()
 * @method static Builder|Address newQuery()
 * @method static Builder|Address query()
 * @method static Builder|Address whereAddressCategoryId($value)
 * @method static Builder|Address whereCreatedAt($value)
 * @method static Builder|Address whereEmail($value)
 * @method static Builder|Address whereId($value)
 * @method static Builder|Address whereInfoOnChanges($value)
 * @method static Builder|Address whereToken($value)
 * @method static Builder|Address whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \App\Models\AddressCategory $addressCategory
 */
class Address extends Model
{
    protected $table = 'address';
    protected $fillable = [
        'address_category_id',
        'email',
        'token',
        'info_on_changes',
    ];
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/addresses/'.$this->getKey());
    }

    public function addressCategory() {
        return $this->belongsTo(AddressCategory::class);
    }
}
