<?php
namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Brackets\AdminAuth\Models\AdminUser as BaseModel;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

/**
 * App\Models\AdminUser
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property int $activated
 * @property int $forbidden
 * @property string $language
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $last_login_at
 * @property-read string|null $avatar_thumb_url
 * @property-read string $full_name
 * @property-read UrlGenerator|string $resource_url
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read Collection|MusicStyle[] $musicStyles
 * @property-read int|null $music_styles_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @method static Builder|AdminUser newModelQuery()
 * @method static Builder|AdminUser newQuery()
 * @method static Builder|AdminUser permission($permissions)
 * @method static Builder|AdminUser query()
 * @method static Builder|AdminUser role($roles, $guard = null)
 * @method static Builder|AdminUser whereActivated($value)
 * @method static Builder|AdminUser whereCreatedAt($value)
 * @method static Builder|AdminUser whereDeletedAt($value)
 * @method static Builder|AdminUser whereEmail($value)
 * @method static Builder|AdminUser whereFirstName($value)
 * @method static Builder|AdminUser whereForbidden($value)
 * @method static Builder|AdminUser whereId($value)
 * @method static Builder|AdminUser whereLanguage($value)
 * @method static Builder|AdminUser whereLastLoginAt($value)
 * @method static Builder|AdminUser whereLastName($value)
 * @method static Builder|AdminUser wherePassword($value)
 * @method static Builder|AdminUser whereRememberToken($value)
 * @method static Builder|AdminUser whereUpdatedAt($value)
 * @mixin Eloquent
 */
class AdminUser extends BaseModel
{
    public function musicStyles()
    {
        return $this->belongsToMany(MusicStyle::class, 'admin_users_music_style', 'admin_user_id', 'music_style_id');
    }

    public function __toString()
    {
        return $this->full_name;
    }

    /************* Media ********************/

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->accepts('image/*')
            ->maxNumberOfFiles(1) // Set the file count limit
        ;
    }

}
