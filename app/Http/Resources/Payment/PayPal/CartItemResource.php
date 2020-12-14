<?php
namespace App\Http\Resources\Payment\PayPal;

use App\Helper\MyLang;
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
            'rowId'     => $this->rowId,
            'id'        => $this->id,
            'name'      => $this->name,
            'price'     => $this->price,
            'taxRate'   => $this->taxRate,
            'qty'       => $this->qty,
        ];
    }
}
