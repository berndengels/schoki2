<?php
namespace App\Http\Resources\Payment\PayPal;

use App\Helper\MyMoney;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Request;
use Spatie\TaxCalculator\HasTax;

class CartItemResource extends JsonResource implements HasTax
{
    private $taxRate;
    private $netto;

    public function __construct($resource)
    {
        parent::__construct($resource);

    }

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
//            'rowId'     => $this->rowId,
            'sku'       => $this->id,
            'name'      => $this->name,
            'price'     => MyMoney::getNettoRounded($this->price),
//            'tax'       => $this->taxRate,
            'quantity'  => $this->qty,
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
