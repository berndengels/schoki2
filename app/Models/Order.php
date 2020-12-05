<?php

namespace App\Models;

use App\Models\Ext\HasUser;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $shoppingcart_id
 * @property string $instance
 * @property string $content
 * @property string $price_total
 * @property int $created_by
 * @property int|null $updated_by
 * @property int $delivered
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $createdBy
 * @property-read mixed $resource_url
 * @property-read Collection|OrderItem[] $orderItems
 * @property-read int|null $order_items_count
 * @property-read User|null $updatedBy
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereContent($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereCreatedBy($value)
 * @method static Builder|Order whereDelivered($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereInstance($value)
 * @method static Builder|Order wherePriceTotal($value)
 * @method static Builder|Order whereShoppingcartId($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUpdatedBy($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    use HasUser;

    protected $table = 'order';
    protected $with = ['created_by','updated_by'];
    protected $fillable = [
        'price_total',
        'delivered_at',
        'created_by',
        'updated_by',
    ];
    public $timestamps = true;
    protected $dates = ['created_at','updated_at','delivered_at'];
    protected $appends = ['resource_url','delivered'];

    public function getDeliveredAttribute()
    {
        return !!$this->delivered_at;
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/orders/'.$this->getKey());
    }
}
