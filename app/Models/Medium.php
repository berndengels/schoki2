<?php
namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Medium extends Media
{
    protected $table = 'media';
    protected $appends = ['resource_url'];
    protected $fillable = [
        'model_type',
        'model_id',
        'uuid',
        'collection_name',
        'name',
        'file_name',
        'mime_type',
        'disk',
        'conversions_disk',
        'size',
        'manipulations',
        'custom_properties',
        'responsive_images',
        'order_column',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/media/'.$this->getKey());
    }
}
