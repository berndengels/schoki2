<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\OrderItem
 *
 * @property int $id
 * @property int $quantity
 * @property string $price_total
 * @property int $product_id
 * @property int $order_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Order $order
 * @property-read Product $product
 * @method static Builder|OrderItem newModelQuery()
 * @method static Builder|OrderItem newQuery()
 * @method static Builder|OrderItem query()
 * @method static Builder|OrderItem whereCreatedAt($value)
 * @method static Builder|OrderItem whereId($value)
 * @method static Builder|OrderItem whereOrderId($value)
 * @method static Builder|OrderItem wherePriceTotal($value)
 * @method static Builder|OrderItem whereProductId($value)
 * @method static Builder|OrderItem whereQuantity($value)
 * @method static Builder|OrderItem whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string|null $size
 * @method static Builder|OrderItem whereSize($value)
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item';
    protected $fillable = [
        'size',
        'order_id',
        'product_id',
        'quantity',
        'price_total',
    ];
    public $timestamps = true;

    public function getPriceTotalAttribute()
    {
        return $this->product->price * $this->quantity;
    }

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
