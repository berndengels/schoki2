<?php
namespace App\Http\Resources\Payment\Stripe;

use App\Helper\MyMoney;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Request;
use Spatie\TaxCalculator\HasTax;

class CartItemResource extends JsonResource implements HasTax
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var CartItem $this
         */
        return [
            'description'       => $this->name,
            'price'             => MyMoney::getBrutto($this->price),
            'quantity'          => $this->qty,
        ];
    }
    public function basePrice(): float
    {
        return MyMoney::getNettoRounded($this->price);
    }

    public function taxedPrice(): float
    {
        $taxRate = env('PAYMENT_TAX_RATE');
        return $this->price * (100 + $taxRate) / 100;
    }

    public function taxPrice(): float
    {
        $tax = round($this->taxedPrice() - $this->basePrice(), 3);
        return round($tax, 2);
    }
}
