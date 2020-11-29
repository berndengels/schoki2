<?php
namespace App\Models;

use App\Models\Ext\HasAdminUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasAdminUser;

    protected $table = 'event';
    protected $fillable = [
        'title',
        'subtitle',
        'category_id',
        'theme_id',
        'description',
        'links',
        'event_date',
        'event_time',
        'is_periodic',
        'is_published',
        'created_by',
        'updated_by',
    ];

    protected $dates = ['created_at', 'updated_at', 'event_date'];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/events/'.$this->getKey());
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
