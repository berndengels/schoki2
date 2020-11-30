<?php
namespace App\Models;

use Spatie\Permission\Models\Permission as BaseModel;

class Permission extends BaseModel
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
        return url('/admin/permissions/'.$this->getKey());
    }
}
