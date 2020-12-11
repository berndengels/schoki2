<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property int|null $music_style_id
 * @property string $email
 * @property string $name
 * @property string $message
 * @property Carbon $created_at
 * @property-read mixed $resource_url
 * @method static Builder|Message newModelQuery()
 * @method static Builder|Message newQuery()
 * @method static Builder|Message query()
 * @method static Builder|Message whereCreatedAt($value)
 * @method static Builder|Message whereEmail($value)
 * @method static Builder|Message whereId($value)
 * @method static Builder|Message whereMessage($value)
 * @method static Builder|Message whereMusicStyleId($value)
 * @method static Builder|Message whereName($value)
 * @mixin Eloquent
 * @property-read \App\Models\MusicStyle|null $musicStyle
 */
class Message extends Model
{
    protected $table = 'message';
    protected $fillable = [
        'music_style_id',
        'email',
        'name',
        'message',
    ];
    public $timestamps = false;
    protected $dates = [
        'created_at',
    ];
    protected $appends = ['resource_url'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
   }
    public function musicStyle()
    {
        return $this->belongsTo(MusicStyle::class);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/messages/'.$this->getKey());
    }
}
