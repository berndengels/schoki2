<?php
namespace App\Http\Resources\Payment\Stripe;

use App\Helper\MyLang;
use App\Helper\MyMoney;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Request;

class CartItemResource extends JsonResource
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
        $language = MyLang::getPrimary();
        return [
//            'id'                => $this->id,
//            'object'            => $this->name,
            'description'       => $this->name,
            'price'             => MyMoney::getBrutto($this->price),
            'quantity'          => $this->qty,
//            'taxes'             => $this->taxRate,
//            'currency'          => 'EUR',
//            'amount_subtotal'   => (int) ($this->subtotal(null) * 100),
//            'amount_total'      => (int) ($this->total(null) * 100),
        ];
    }
}
