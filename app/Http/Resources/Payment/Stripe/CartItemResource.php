<?php
namespace App\Http\Resources\Payment\Stripe;

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
        return [
            'description'       => $this->name,
            'price'             => MyMoney::getBrutto($this->price),
            'quantity'          => $this->qty,
        ];
    }
}
