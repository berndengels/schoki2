<?php

namespace App\Models;

use App\Models\Ext\HasAdminUser;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasAdminUser;

    protected $table = 'images';

    protected $fillable = [

    ];
    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/images/'.$this->getKey());
    }
}
