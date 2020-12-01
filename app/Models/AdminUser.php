<?php
namespace App\Models;

use Brackets\AdminAuth\Models\AdminUser as BaseModel;

class AdminUser extends BaseModel
{
    public function musicStyles()
    {
        return $this->belongsToMany(MusicStyle::class, 'admin_users_music_style', 'admin_user_id', 'music_style_id');
    }
}
