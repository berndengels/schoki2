<?php

namespace App\Models;

use App\Models\Ext\HasAdminUser;
use Illuminate\Database\Eloquent\Model;

class EventTemplate extends Model
{
    use HasAdminUser;

    protected $table = 'event_template';

    protected $fillable = [

    ];


    protected $dates = [

    ];
    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/event-templates/'.$this->getKey());
    }
}
