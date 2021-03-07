<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\ProductStock;
use Illuminate\Http\Resources\Json\JsonResource;

class SpaProductStockResource extends JsonResource
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
         * @var $this ProductStock
         */
        return [
            'stock' => $this->stock,
            'size'  => $this->size,
        ];
    }
}
