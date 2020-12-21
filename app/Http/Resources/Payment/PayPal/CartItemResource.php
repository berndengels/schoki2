<?php
namespace App\Http\Resources\Payment\PayPal;

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
            "sku"       => $this->id,
            "name"      => "$this->name",
//            "price"     => MyMoney::getNettoRounded($this->price),
            "quantity"  => $this->qty,
            "category"  => "PHYSICAL_GOODS",
            "unit_amount" => [
                "currency_code" => config("paypal.currency"),
                "value"         => MyMoney::getNettoRounded($this->price),
            ],
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
