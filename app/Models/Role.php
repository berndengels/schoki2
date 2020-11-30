<?php
namespace App\Models;

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role as BaseModel;

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
