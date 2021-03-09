<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Resources\Json\JsonResource;

class SpaCartItemResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var $this CartItem
         */
        return [
            'id'            => $this->id,
            'rowId'         => $this->rowId,
            'name'    		=> $this->name,
            'qty'           => $this->qty,
            'price'         => $this->price,
            'tax'           => $this->tax,
            'priceTotal'    => $this->priceTotal,
            'weight'        => 0,
            'options'       => $this->options,
        ];
    }
}
