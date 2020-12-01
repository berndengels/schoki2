<?php
namespace App\Models;

use App\Models\Ext\HasAdminUser;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use HasAdminUser;
    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

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

    /* ************************ RELATIONS ************************* */

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

/*
    public function images()
    {
        return $this->hasMany(Image::class);
    }
*/
    /* ************************ MEDIA ************************* */

    /*
        public function media(): MorphMany
        {
            return $this->morphMany(Media::class);
        }

        public function addMedia($file): FileAdder
        {
            // TODO: Implement addMedia() method.
        }

        public function copyMedia($file): FileAdder
        {
            // TODO: Implement copyMedia() method.
        }

        public function hasMedia(string $collectionMedia = ''): bool
        {
            // TODO: Implement hasMedia() method.
        }

        public function getMedia(string $collectionName = 'default', $filters = []): Collection
        {
            // TODO: Implement getMedia() method.
        }

        public function clearMediaCollection(string $collectionName = 'default'): HasMedia
        {
        }

        public function clearMediaCollectionExcept(string $collectionName = 'default', $excludedMedia = []): HasMedia
        {
            // TODO: Implement clearMediaCollectionExcept() method.
        }

        public function shouldDeletePreservingMedia(): bool
        {
            // TODO: Implement shouldDeletePreservingMedia() method.
        }

        public function loadMedia(string $collectionName)
        {
            // TODO: Implement loadMedia() method.
        }

        public function addMediaConversion(string $name): Conversion
        {
            // TODO: Implement addMediaConversion() method.
        }
    */
    public function registerMediaConversions( Media $media = null ): void
    {
        $this->autoRegisterThumb200();
        $this->addMediaConversion('detail_hd')
            ->width(1920)
            ->height(1080)
            ->performOnCollections('images');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useDisk('images')
            ->accepts('image/jpeg','image/jpg')
            ->maxNumberOfFiles(3) // Set the file count limit
            ->maxFilesize(5*1024*1024) // Set the file size limit
//            ->canView('media.view') // Set the ability (Gate) which is required to view the medium (in most cases you would want to call private())
//            ->canUpload('upload') // Set the ability (Gate) which is required to upload & attach new files to the model
        ;
    }
/*
    public function registerAllMediaConversions(): void
    {
        // TODO: Implement registerAllMediaConversions() method.
    }
*/
}
