<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpaProductResource extends JsonResource
{
    public static $wrap = 'products';
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
            'price'         => $this->price,
            'price_netto'   => $this->price_netto,
            'hasSize'       => $this->hasSize,
            'sizes'         => $this->sizes->toArray(),
            'stocks'        => SpaProductStockResource::collection($this->stocks)->toArray($request),
            'thumb'         => $this->thumb,
        ];
    }
}
