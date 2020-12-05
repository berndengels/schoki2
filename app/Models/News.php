<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\News
 *
 * @property int $id
 * @property Carbon|null $end_date
 * @property string $title
 * @property string $text
 * @property int $created_by
 * @property int|null $updated_by
 * @property int $show_item
 * @property int $is_published
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $resource_url
 * @method static Builder|News newModelQuery()
 * @method static Builder|News newQuery()
 * @method static Builder|News query()
 * @method static Builder|News whereCreatedAt($value)
 * @method static Builder|News whereCreatedBy($value)
 * @method static Builder|News whereEndDate($value)
 * @method static Builder|News whereId($value)
 * @method static Builder|News whereIsPublished($value)
 * @method static Builder|News whereShowItem($value)
 * @method static Builder|News whereText($value)
 * @method static Builder|News whereTitle($value)
 * @method static Builder|News whereUpdatedAt($value)
 * @method static Builder|News whereUpdatedBy($value)
 * @mixin Eloquent
 */
class News extends Model
{
    protected $fillable = [
        'end_date',
        'title',
        'text',
        'created_by',
        'updated_by',
        'show_item',
        'is_published',

    ];


    protected $dates = [
        'end_date',
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/news/'.$this->getKey());
    }
}
