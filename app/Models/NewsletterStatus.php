<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterStatus extends Model
{
    protected $table = 'newsletter_status';

    protected $fillable = [
        'name',
    
    ];
    
    
    protected $dates = [
    
    ];
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/newsletter-statuses/'.$this->getKey());
    }
}
