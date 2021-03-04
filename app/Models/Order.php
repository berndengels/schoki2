<?php
namespace App\Models;

use Eloquent;
use App\Models\Ext\HasCustomer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 * @property-read Customer $createdBy
 * @property-read mixed $resource_url
 * @property-read Collection|OrderItem[] $orderItems
 * @property-read int|null $order_items_count
 * @property-read Customer|null $updatedBy
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
 * @property Carbon|null $delivered_at
 * @method static Builder|Order whereDeliveredAt($value)
 * @property string|null $delivered_on
 * @property string|null $paid_on
 * @method static Builder|Order whereDeliveredOn($value)
 * @method static Builder|Order wherePaidOn($value)
 * @property string|null $amount_received
 * @property string $payment_id
 * @property string $payment_provider
 * @property string $cart_instance
 * @method static Builder|Order whereAmountReceived($value)
 * @method static Builder|Order whereCartInstance($value)
 * @method static Builder|Order wherePaymentId($value)
 * @method static Builder|Order wherePaymentProvider($value)
 * @property string|null $mail_to_shop
 * @method static Builder|Order whereMailToShop($value)
 * @property string|null $porto
 * @method static Builder|Order wherePorto($value)
 */
class Order extends Model
{
    use HasCustomer, HasFactory;

    protected $table = 'order';
    protected $with = ['orderItems','createdBy','updatedBy'];
    protected $fillable = [
        'price_total',
        'delivered_on',
        'created_by',
        'updated_by',
        'paid_on',
        'amount_received',
        'porto',
        'payment_id',
        'payment_provider',
        'mail_to_shop',
    ];
    public $timestamps = true;
    protected $dates = ['created_at','updated_at','delivered_on'];
    protected $appends = ['resource_url','delivered'];

    public function getDeliveredAttribute()
    {
        return !!$this->delivered_at;
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/orders/'.$this->getKey());
    }
}
