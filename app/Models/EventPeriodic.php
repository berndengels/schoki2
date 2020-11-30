<?php

namespace App\Models;

use App\Models\Ext\HasAdminUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventPeriodic extends Model
{
    use HasAdminUser;

    protected $table = 'event_periodic';

    protected $fillable = [
        'id',
        'theme_id',
        'category_id',
        'periodic_position',
        'periodic_weekday',
        'title',
        'subtitle',
        'description',
        'links',
        'event_date',
        'event_time',
        'is_published',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];


    protected $dates = [

    ];
    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/event-periodics/'.$this->getKey());
    }

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * @return HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
