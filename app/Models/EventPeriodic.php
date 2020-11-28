<?php

namespace App\Models;

use App\Models\Ext\HasAdminUser;
use Illuminate\Database\Eloquent\Model;

class EventPeriodic extends Model
{
    use HasAdminUser;

    protected $table = 'event_periodic';

    protected $fillable = [

    ];


    protected $dates = [

    ];
    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/event-periodics/'.$this->getKey());
    }
}
