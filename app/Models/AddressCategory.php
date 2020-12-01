<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressCategory extends Model
{
    protected $table = 'address_catergory';

    protected $fillable = [
    
    ];
    
    
    protected $dates = [
    
    ];
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/address-categories/'.$this->getKey());
    }
}
