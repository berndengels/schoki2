<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemType extends Model
{
    protected $table = 'menu_item_type';
    protected $fillable = [
        'type',
        'label',
    ];
    public $timestamps = false;
}
