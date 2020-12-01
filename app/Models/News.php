<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'end_date',
        'title',
        'text',
        'created_by',
        'updated_by',
        'show_item',
        'is_published',
    
    ];
    
    
    protected $dates = [
        'end_date',
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/news/'.$this->getKey());
    }
}
