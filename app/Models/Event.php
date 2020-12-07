<?php
namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use App\Helper\MyDate;
use App\Models\Ext\HasAdminUser;
use App\Repositories\EventEntityRepository;
use App\Repositories\EventPeriodicRepository;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia as HasMediaAlias;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Event
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
 * @property \Illuminate\Support\Carbon $event_date
 * @property string $event_time
 * @property string|null $price
 * @property int $is_published
 * @property int|null $is_periodic
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Category $category
 * @property-read \Brackets\AdminAuth\Models\AdminUser $createdBy
 * @property-read mixed $resource_url
 * @property-read MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read Theme|null $theme
 * @property-read \Brackets\AdminAuth\Models\AdminUser|null $updatedBy
 * @method static Builder|Event newModelQuery()
 * @method static Builder|Event newQuery()
 * @method static Builder|Event query()
 * @method static Builder|Event whereCategoryId($value)
 * @method static Builder|Event whereCreatedAt($value)
 * @method static Builder|Event whereCreatedBy($value)
 * @method static Builder|Event whereDescription($value)
 * @method static Builder|Event whereEventDate($value)
 * @method static Builder|Event whereEventTime($value)
 * @method static Builder|Event whereId($value)
 * @method static Builder|Event whereIsPeriodic($value)
 * @method static Builder|Event whereIsPublished($value)
 * @method static Builder|Event whereLinks($value)
 * @method static Builder|Event wherePrice($value)
 * @method static Builder|Event whereSubtitle($value)
 * @method static Builder|Event whereThemeId($value)
 * @method static Builder|Event whereTitle($value)
 * @method static Builder|Event whereUpdatedAt($value)
 * @method static Builder|Event whereUpdatedBy($value)
 * @mixin Eloquent
 * @property-read mixed $images
 * @property-read mixed $media_name
 * @property-read mixed $thumbnails
 * @method static Builder|Event allActual()
 * @method static Builder|Event allActualMerged()
 * @method static Builder|Event byCategorySlug($slug, $sinceToday = true)
 * @method static Builder|Event byThemeSlug($slug, $sinceToday = true)
 * @method static Builder|Event mergedByCategorySlug($slug, $sinceToday = true)
 * @method static Builder|Event mergedByDate($date)
 * @method static Builder|Event mergedByDateAndCategory($date, $slug)
 * @method static Builder|Event mergedByDateAndTheme($date, $slug)
 * @method static Builder|Event mergedByThemeSlug($slug, $sinceToday = true)
 */
class Event extends Model implements HasMediaAlias
{
    use HasAdminUser;
    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    private $mediaName = 'images';
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
    protected $appends = ['resource_url','images','thumbnails','mediaName'];

    public function setEventDateAttribute( $value ) {
        $this->event_date = (new Carbon($value))->format('Y-m-d');
    }

    public function getEventDateAttribute( $value ) {
        return (new Carbon($value))->format('Y-m-d');
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/events/'.$this->getKey());
    }

    public function getMediaNameAttribute()
    {
        return $this->mediaName;
    }

    public function getImagesAttribute() {
        if($this->hasMedia($this->mediaName)) {
            return $this->getMedia($this->mediaName);
        }
        return collect([]);
    }

    public function getThumbnailsAttribute() {
        if($this->hasMedia($this->mediaName)) {
            return $this->getThumbs200ForCollection($this->mediaName);
        }
        return collect([]);
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

    public function scopeAllActual(Builder $query)
    {
        $result = $query
            ->with(['category','theme'])
            ->where('is_published', 1)
            ->whereDate('event_date','>=', MyDate::getUntilValidDate())
            ->orderBy('event_date')
        ;

        return $result;
    }

    public function scopeAllActualMerged()
    {
        $repo			= new EventPeriodicRepository();
        $repoEntity		= new EventEntityRepository();

        $periodicEvents	= $repo->getAllPeriodicDates(true, true);
        $datedEvents	= self::allActual()->get()->keyBy('event_date');

        $mapped	= $repoEntity->mapToEventEntityCollection($datedEvents);
        $merged	= $periodicEvents->merge($mapped)->sortKeys();

        return $merged;
    }

    public function scopeByCategorySlug(Builder $query, $slug, $sinceToday = true)
    {
        $result = $query
            ->with(['category','theme'])
            ->where('is_published', 1)
            ->when($sinceToday, function($query) {
                return $query->whereDate('event_date','>=', MyDate::getUntilValidDate());
            })
            ->whereHas('category', function($query) use ($slug) {
                $query->where('slug', $slug);
            });
        return $result;
    }

    public function scopeByThemeSlug(Builder $query, $slug, $sinceToday = true)
    {
        $result = $query
            ->with(['category','theme'])
            ->where('is_published', 1)
            ->when($sinceToday, function($query) {
                return $query->whereDate('event_date','>=', MyDate::getUntilValidDate());
            })
            ->whereHas('theme', function($query) use ($slug) {
                $query->where('slug', $slug);
            });

        return $result;
    }

    public function scopeMergedByCategorySlug(Builder $query, $slug, $sinceToday = true)
    {
        $repo 		= new EventPeriodicRepository();
        $repoEntity	= new EventEntityRepository();

        $periodicEvents	= $repo->getAllPeriodicDatesByCategory($slug);
        $datedEvents = $this->scopeByCategorySlug($query, $slug, $sinceToday)->get()->keyBy('event_date');

        $mappedEvents = $repoEntity->mapToEventEntityCollection($datedEvents);
//		$merged = $periodicEvents->merge($mappedEvents)->sortKeys()->paginate(config('event.paginationLimit'));
        $merged = $periodicEvents->merge($mappedEvents)->sortKeys();

        return $merged;
    }

    public function scopeMergedByDate(Builder $query, $date )
    {
        $repo 	= new EventPeriodicRepository();
        $event	= self::whereDate('event_date', $date)->first();

        if( $event ) {
            return $event;
        }

        $periodicEvent	= $repo->getPeriodicEventByDate($date);
        if( $periodicEvent ) {
            return $periodicEvent;
        }
        return null;
    }

    public function scopeMergedByDateAndCategory(Builder $query, $date, $slug )
    {
        $repo 		= new EventPeriodicRepository();
        $repoEntity	= new EventEntityRepository();

        $event = self::whereDate('event_date', $date)
            ->where('is_published', 1)
            ->whereHas('category', function($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->first();
        if($event) {
            $entity = $repoEntity->mapToEventEntity($event, $date);
            if($entity) {
                return $entity;
            }
        }

        $periodicEvent	= $repo->getPeriodicEventByDateAndCategory($date, $slug);
        if($periodicEvent) {
            return $periodicEvent;
        }
        return null;
    }

    public function scopeMergedByDateAndTheme(Builder $query, $date, $slug )
    {
        $repo 		= new EventPeriodicRepository();
        $repoEntity	= new EventEntityRepository();

        $event = self::whereDate('event_date', $date)
            ->where('is_published', 1)
            ->whereHas('theme', function($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->first();
        if($event) {
            $entity = $repoEntity->mapToEventEntity($event, $date);
            if($entity) {
                return $entity;
            }
        }

        $periodicEvent	= $repo->getPeriodicEventByDateAndCategory($date, $slug);
        if($periodicEvent) {
            return $periodicEvent;
        }
        return null;
    }

    public function scopeMergedByThemeSlug(Builder $query, $slug, $sinceToday = true)
    {
        $repo 		= new EventPeriodicRepository();
        $repoEntity	= new EventEntityRepository();

        $periodicEvents	= $repo->getAllPeriodicDatesByTheme($slug);
        $datedEvents = $this->scopeByThemeSlug($query, $slug, $sinceToday)->get()->keyBy('event_date');

        $mappedEvents = $repoEntity->mapToEventEntityCollection($datedEvents);
//		$merged = $periodicEvents->merge($mappedEvents)->sortKeys()->paginate(config('event.paginationLimit'));
        $merged = $periodicEvents->merge($mappedEvents)->sortKeys();

        return $merged;
    }

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
            ->performOnCollections($this->mediaName);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection($this->mediaName)
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
