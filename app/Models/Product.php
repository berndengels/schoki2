<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
    ];
    protected $dates = [
    ];
    public $timestamps = true;
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */
    public function getResourceUrlAttribute()
    {
        return url('/admin/products/'.$this->getKey());
    }
}
