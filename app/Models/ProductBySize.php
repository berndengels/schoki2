<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductBySize
 *
 * @property int $product_id
 * @property int $size_id
 * @property-read ProductSize $productSize
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @method static Builder|ProductBySize newModelQuery()
 * @method static Builder|ProductBySize newQuery()
 * @method static Builder|ProductBySize query()
 * @method static Builder|ProductBySize whereProductId($value)
 * @method static Builder|ProductBySize whereSizeId($value)
 * @mixin Eloquent
 * @property-read Product $product
 * @property-read ProductSize $size
 */
class ProductBySize extends Model
{
    use HasFactory;

    protected $table = 'product_by_size';
    protected $with = ['product', 'size', 'stock'];
    protected $fillable = ['product_id','size_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class);
    }

    public function stock()
    {
        return $this->belongsTo(ProductStock::class, 'size_id', 'size_id');
    }
}
