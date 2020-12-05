<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Newsletter
 *
 * @property int $id
 * @property int $tag_id
 * @property int $created_by
 * @property int|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $resource_url
 * @method static Builder|Newsletter newModelQuery()
 * @method static Builder|Newsletter newQuery()
 * @method static Builder|Newsletter query()
 * @method static Builder|Newsletter whereCreatedAt($value)
 * @method static Builder|Newsletter whereCreatedBy($value)
 * @method static Builder|Newsletter whereId($value)
 * @method static Builder|Newsletter whereTagId($value)
 * @method static Builder|Newsletter whereUpdatedAt($value)
 * @method static Builder|Newsletter whereUpdatedBy($value)
 * @mixin Eloquent
 */
class Newsletter extends Model
{
    protected $table = 'newsletter';

    protected $fillable = [
        'tag_id',
        'created_by',
        'updated_by',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/newsletters/'.$this->getKey());
    }
}
