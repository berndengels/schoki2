<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Ext\HasAdminUser;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Page
 *
 * @property int $id
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $title
 * @property string $slug
 * @property array $body
 * @property int $is_published
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \Brackets\AdminAuth\Models\AdminUser $createdBy
 * @property-read mixed $resource_url
 * @property-read \Brackets\AdminAuth\Models\AdminUser|null $updatedBy
 * @method static Builder|Page newModelQuery()
 * @method static Builder|Page newQuery()
 * @method static Builder|Page query()
 * @method static Builder|Page whereBody($value)
 * @method static Builder|Page whereCreatedAt($value)
 * @method static Builder|Page whereCreatedBy($value)
 * @method static Builder|Page whereId($value)
 * @method static Builder|Page whereIsPublished($value)
 * @method static Builder|Page whereSlug($value)
 * @method static Builder|Page whereTitle($value)
 * @method static Builder|Page whereUpdatedAt($value)
 * @method static Builder|Page whereUpdatedBy($value)
 * @mixin Eloquent
 */
class Page extends Model
{
    use HasAdminUser;

    protected $table = 'page';
    public $timestamps = true;
    protected $fillable = [
        'created_by',
        'updated_by',
        'title',
        'slug',
        'body',
        'is_published',
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/pages/'.$this->getKey());
    }

    public static function boot() {
        parent::boot();
        Page::creating(function($entity) {
            $entity->slug = Str::slug(str_replace('.','-',$entity->title), '-', 'de');
        });
        Page::updating(function($entity) {
            $entity->slug = Str::slug(str_replace('.','-',$entity->title), '-', 'de');
        });
    }

    /**
     * @param string $value
     * @return array
     */
    public function getBodyAttribute($value = '')
    {
        if('' !== $value) {
            $wrapper = '<div class="row embed-responsive-wrapper text-center"><div class="embed-responsive embed-responsive-16by9 m-0 p-0">%%</div></div>';
            $sanitized = preg_replace("/(<iframe[^>]+><\/iframe>)/i", str_replace('%%','$1', $wrapper), trim($value));
            return preg_replace(['/^<p>(<br[ ]?[\/]?>){1,}/i','/(<br[ ]?[\/]?>){1,}<\/p>$/i'],['<p>','</p>'], $sanitized);
        }
    }
}
