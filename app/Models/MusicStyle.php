<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicStyle extends Model
{
    protected $table = 'music_style';

    protected $fillable = [
        'name',
        'slug',

    ];

    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/music-styles/'.$this->getKey());
    }

    public function adminUsers()
    {
        return $this->belongsToMany(AdminUser::class);
    }
}
