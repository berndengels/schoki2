<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';
    protected $appends = ['price_total'];
    protected $fillable = [
    ];

    protected $dates = [
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

}
