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
 */
class ProductSize extends Model
{
    protected $table = 'product_size';
    protected $fillable = ['name'];

    public $timestamps = false;

    public function __toString()
    {
        return $this->name;
    }
}
