<?php
namespace App\Models;

use Eloquent;
use App\Models\Ext\HasAdminUser;
use App\Models\Ext\PriceTrait;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Gloudemans\Shoppingcart\Cart;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Gloudemans\Shoppingcart\CanBeBought;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\TaxCalculator\Traits\HasTaxWithRate;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property int $is_published
 * @property int $is_available
 * @property int $created_by
 * @property int|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \Brackets\AdminAuth\Models\AdminUser $createdBy
 * @property-read mixed $resource_url
 * @property-read MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Brackets\AdminAuth\Models\AdminUser|null $updatedBy
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereCreatedBy($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereIsAvailable($value)
 * @method static Builder|Product whereIsPublished($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product whereUpdatedBy($value)
 * @mixin Eloquent
 * @property string|null $price_netto
 * @method static Builder|Product wherePriceNetto($value)
 * @property-read mixed $has_size
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductStock[] $stocks
 * @property-read int|null $stocks_count
 * @method static Builder|Product whereStock($value)
 * @property-read mixed $size
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductBySize[] $sizes
 * @property-read int|null $sizes_count
 */
class Product extends Model implements Buyable, HasMedia
{
    use CanBeBought;
    use HasAdminUser;
    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;
    use PriceTrait;
    use HasTaxWithRate;

    protected $table = 'product';
    protected $appends = ['resource_url','hasSize','size'];
    protected $fillable = [
        'name',
        'description',
        'price',
        'is_published',
        'is_available',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->price_netto;
    }

    public function getCartItem(Cart $cart = null, $id)
    {
        if (!$cart) {
            return null;
        }
        return $cart->content()->firstWhere('id', $id);
    }

    public function getCartItems(Cart $cart = null)
    {
        if (!$cart) {
            return null;
        }
        $cartItems = $cart->search(function ($item) {
            $productID  = $item->options['product_id'];
            $size       = $item->options['size'] ?? null;
            $id         = $size ? $productID.'-'.$size : $productID;
            return $item->id === $id;
        });
        return $cartItems->values() ?? null;
    }

    public function getHasSizeAttribute()
    {
        return $this->stocks()->whereHas('size')->count() > 0;
    }

    public function getSizeAttribute()
    {
        return $this->size ?? null;
    }

    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    public function setSizeAttribute($size)
    {
        $this->attributes['size'] = $size;
    }

    public function sizes()
    {
        return $this->belongsToMany(ProductSize::class, 'product_by_size', 'product_id', 'size_id');
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class, 'product_id', 'id');
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/products/'.$this->getKey());
    }

    /************** media ****************/

    public function registerMediaConversions(Media $media = null): void
    {
        $this->autoRegisterThumb200();
        $this->addMediaConversion('detail_hd')
            ->width(1920)
            ->height(1080)
            ->performOnCollections('product_images');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_images')
            ->useDisk('images')
            ->accepts('image/jpeg', 'image/jpg')
            ->maxNumberOfFiles(3) // Set the file count limit
            ->maxFilesize(5 * 1024 * 1024) // Set the file size limit
        ;
    }
    /*
        public function getMedia(string $collectionName = 'default', $filters = []): Collection
        {}

        public function media(): MorphMany
        {
            return $this->morphTo(Media::class);
        }

        public function addMedia($file): FileAdder
        {
            $this->addMedia($file);
            return $this;
        }

        public function copyMedia($file): FileAdder
        {
            // TODO: Implement copyMedia() method.
        }

        public function hasMedia(string $collectionMedia = ''): bool
        {
            // TODO: Implement hasMedia() method.
        }

        public function clearMediaCollection(string $collectionName = 'default'): HasMedia
        {
            // TODO: Implement clearMediaCollection() method.
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
            $this->loadMedia('product_images');
        }

        public function addMediaConversion(string $name): Conversion
        {
            // TODO: Implement addMediaConversion() method.
        }

        public function registerAllMediaConversions(): void
        {
            // TODO: Implement registerAllMediaConversions() method.
        }
    */
}
