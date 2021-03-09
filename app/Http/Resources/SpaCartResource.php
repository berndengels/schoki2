<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Resources\Json\JsonResource;

class SpaCartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var $this Cart
         */
        return [
            'content'       => $this->content()->values(),
            'priceTotal'    => $this->priceTotal(2),
            'subtotal'      => $this->subtotal(2),
            'tax'           => $this->tax(2),
        ];
    }
}
