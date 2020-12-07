<?php

namespace App\Models;

use App\Models\Ext\HasAdminUser;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\EventPeriodic
 *
 * @property int $id
 * @property int|null $theme_id
 * @property int $category_id
 * @property string $periodic_position
 * @property string $periodic_weekday
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $title
 * @property string|null $subtitle
 * @property string|null $description
 * @property string|null $links
 * @property string $event_date
 * @property string $event_time
 * @property string|null $price
 * @property int $is_published
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read Category $category
 * @property-read \Brackets\AdminAuth\Models\AdminUser $createdBy
 * @property-read mixed $resource_url
 * @property-read Collection|Image[] $images
 * @property-read int|null $images_count
 * @property-read Theme|null $theme
 * @property-read \Brackets\AdminAuth\Models\AdminUser|null $updatedBy
 * @method static Builder|EventPeriodic newModelQuery()
 * @method static Builder|EventPeriodic newQuery()
 * @method static Builder|EventPeriodic query()
 * @method static Builder|EventPeriodic whereCategoryId($value)
 * @method static Builder|EventPeriodic whereCreatedAt($value)
 * @method static Builder|EventPeriodic whereCreatedBy($value)
 * @method static Builder|EventPeriodic whereDescription($value)
 * @method static Builder|EventPeriodic whereEventDate($value)
 * @method static Builder|EventPeriodic whereEventTime($value)
 * @method static Builder|EventPeriodic whereId($value)
 * @method static Builder|EventPeriodic whereIsPublished($value)
 * @method static Builder|EventPeriodic whereLinks($value)
 * @method static Builder|EventPeriodic wherePeriodicPosition($value)
 * @method static Builder|EventPeriodic wherePeriodicWeekday($value)
 * @method static Builder|EventPeriodic wherePrice($value)
 * @method static Builder|EventPeriodic whereSubtitle($value)
 * @method static Builder|EventPeriodic whereThemeId($value)
 * @method static Builder|EventPeriodic whereTitle($value)
 * @method static Builder|EventPeriodic whereUpdatedAt($value)
 * @method static Builder|EventPeriodic whereUpdatedBy($value)
 * @mixin Eloquent
 */
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
    ];
    public $timestamps = true;
    protected $appends = ['resource_url','images'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/event-periodics/'.$this->getKey());
    }

    public function setImagesAttribute() {
        $this->images = collect([]);
    }

    public function getImagesAttribute() {
        return collect([]);
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
}
