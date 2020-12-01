<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $fillable = [
        'parent_id',
        'menu_item_type_id',
        'name',
        'icon',
        'fa_icon',
        'url',
        'lft',
        'rgt',
        'lvl',
        'api_enabled',
        'is_published',
    
    ];
    
    
    protected $dates = [
    
    ];
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/menus/'.$this->getKey());
    }
}
