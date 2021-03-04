<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    protected $size = null;

    public function __construct($resource, $size = null)
    {
        if ($size) {
            $this->size = $size;
        }
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->size ? $this->id . '-' . $this->size : $this->id,
            'name'          => $this->name,
            'price'         => $this->price_netto,
            'weight'        => 0,
            'qty'           => 1,
        ];
    }
}
