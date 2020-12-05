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
 * App\Models\EventTemplate
 *
 * @property int $id
 * @property int|null $theme_id
 * @property int $category_id
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $title
 * @property string|null $subtitle
 * @property string|null $description
 * @property string|null $links
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read Category $category
 * @property-read \Brackets\AdminAuth\Models\AdminUser $createdBy
 * @property-read mixed $resource_url
 * @property-read Collection|Image[] $images
 * @property-read int|null $images_count
 * @property-read Theme|null $theme
 * @property-read \Brackets\AdminAuth\Models\AdminUser|null $updatedBy
 * @method static Builder|EventTemplate newModelQuery()
 * @method static Builder|EventTemplate newQuery()
 * @method static Builder|EventTemplate query()
 * @method static Builder|EventTemplate whereCategoryId($value)
 * @method static Builder|EventTemplate whereCreatedAt($value)
 * @method static Builder|EventTemplate whereCreatedBy($value)
 * @method static Builder|EventTemplate whereDescription($value)
 * @method static Builder|EventTemplate whereId($value)
 * @method static Builder|EventTemplate whereLinks($value)
 * @method static Builder|EventTemplate whereSubtitle($value)
 * @method static Builder|EventTemplate whereThemeId($value)
 * @method static Builder|EventTemplate whereTitle($value)
 * @method static Builder|EventTemplate whereUpdatedAt($value)
 * @method static Builder|EventTemplate whereUpdatedBy($value)
 * @mixin Eloquent
 */
class EventTemplate extends Model
{
    use HasAdminUser;

    protected $table = 'event_template';
    protected $fillable = [
        'id',
        'theme_id',
        'category_id',
        'title',
        'subtitle',
        'description',
        'links',
        'is_published',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    public $timestamps = false;
    protected $appends = ['resource_url','images'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/event-templates/'.$this->getKey());
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
