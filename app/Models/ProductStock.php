<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductStock
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $product_size_id
 * @property int $stock
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $resource_url
 * @property-read Product $product
 * @property-read ProductSize|null $size
 * @method static Builder|ProductStock newModelQuery()
 * @method static Builder|ProductStock newQuery()
 * @method static Builder|ProductStock query()
 * @method static Builder|ProductStock whereCreatedAt($value)
 * @method static Builder|ProductStock whereId($value)
 * @method static Builder|ProductStock whereProductId($value)
 * @method static Builder|ProductStock whereProductSizeId($value)
 * @method static Builder|ProductStock whereStock($value)
 * @method static Builder|ProductStock whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ProductStock extends Model
{
    protected $table = 'product_stock';
    protected $with = ['product', 'size'];
    protected $fillable = [
        'product_id',
        'product_size_id',
        'stock',
    ];
    protected $dates = [
        'created_at',
        'updated_at',

    ];
    protected $appends = ['resource_url'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id', 'id');
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/product-stocks/'.$this->getKey());
    }
}
