<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductSize
 *
 * @property int $id
 * @property string $name
 * @method static Builder|ProductSize newModelQuery()
 * @method static Builder|ProductSize newQuery()
 * @method static Builder|ProductSize query()
 * @method static Builder|ProductSize whereId($value)
 * @method static Builder|ProductSize whereName($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductBySize[] $productSizes
 * @property-read int|null $product_sizes_count
 */
class ProductSize extends Model
{
    protected $table = 'product_size';
    protected $fillable = ['name'];

    public $timestamps = false;

    public function productSizes()
    {
        return $this->belongsToMany(ProductBySize::class, 'product_by_size');
    }

    public function __toString()
    {
        return $this->name;
    }
}
