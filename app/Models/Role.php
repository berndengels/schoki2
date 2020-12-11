<?php
namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role as BaseModel;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $resource_url
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|Customer[] $users
 * @property-read int|null $users_count
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role permission($permissions)
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereGuardName($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Role extends BaseModel
{
    protected $fillable = [
        'name',
        'guard_name',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $appends = ['resource_url'];


    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/roles/'.$this->getKey());
    }
}
