<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminUsersMusicStyle
 *
 * @property int $admin_user_id
 * @property int $music_style_id
 * @method static Builder|AdminUsersMusicStyle newModelQuery()
 * @method static Builder|AdminUsersMusicStyle newQuery()
 * @method static Builder|AdminUsersMusicStyle query()
 * @method static Builder|AdminUsersMusicStyle whereAdminUserId($value)
 * @method static Builder|AdminUsersMusicStyle whereMusicStyleId($value)
 * @mixin Eloquent
 */
class AdminUsersMusicStyle extends Model
{
    protected $table = 'admin_users_music_style';
    public $timestamps = false;


}
