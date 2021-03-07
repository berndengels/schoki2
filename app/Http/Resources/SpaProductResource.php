<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\SpaProductStockResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SpaProductResource extends JsonResource
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
         * @var $this Product
         */
        return [
            'id'            => $this->id,
            'name'    		=> $this->name,
            'description'   => $this->description,
            'price'         => $this->netto,
            'price_netto'   => $this->price_netto,
            'hasSize'       => $this->hasSize,
            'sizes'         => $this->sizes,
            'stocks'        => SpaProductStockResource::collection($this->stocks),
            'thumb'         => $this->thumb,

        ];
    }
}
