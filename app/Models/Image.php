<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Image
 *
 * @property-read mixed $resource_url
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @mixin Eloquent
 */
class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'external_filename',
        'internal_filename',
        'title',
        'extension',
        'filesize',
        'width',
        'height',
    ];
    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/images/'.$this->getKey());
    }
}
