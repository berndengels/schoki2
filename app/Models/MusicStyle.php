<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * App\Models\MusicStyle
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property-read Collection|AdminUser[] $adminUsers
 * @property-read int|null $admin_users_count
 * @property-read mixed $resource_url
 * @property-read Collection|Message[] $messages
 * @property-read int|null $messages_count
 * @method static Builder|MusicStyle newModelQuery()
 * @method static Builder|MusicStyle newQuery()
 * @method static Builder|MusicStyle query()
 * @method static Builder|MusicStyle whereId($value)
 * @method static Builder|MusicStyle whereName($value)
 * @method static Builder|MusicStyle whereSlug($value)
 * @mixin Eloquent
 */
class MusicStyle extends Model
{
    protected $table = 'music_style';
    protected $fillable = ['name', 'slug',];
    public $timestamps = false;
    protected $appends = ['resource_url'];

    public static function boot() {
        parent::boot();
        self::creating(function($model) {
            $model->slug = Str::slug(str_replace('.','_',$model->name), '-', 'de');
        });
        self::updating(function($model) {
            $model->slug = Str::slug(str_replace('.','_',$model->name), '-', 'de');
        });
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/music-styles/'.$this->getKey());
    }

    public function adminUsers()
    {
        return $this->belongsToMany(AdminUser::class,'admin_users_music_style');
    }

    /**
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function delete()
    {
        $count = $this->adminUsers->count();
        if($count > 0) {
            return back()
                ->with('error','Es existieren noch Customer ('.$count.') mit dieser Kategorie! Bitte vorher löschen.');
        }
        $count = $this->messages->count();
        if($count > 0) {
            return back()
                ->with('error','Es existieren noch Nachrichtens ('.$count.') mit dieser Kategorie! Bitte vorher löschen.');
        }
        return parent::delete();
    }
}
