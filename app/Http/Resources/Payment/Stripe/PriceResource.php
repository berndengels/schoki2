<?php
namespace App\Http\Resources\Payment\Stripe;

use App\Helper\MyMoney;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Request;

class PriceResource extends JsonResource
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
            'unit_amount'   => (int) (MyMoney::getBrutto($this->price) * 100),
            'currency'      => 'eur',
            'product_data'  => [
                'name'  => $this->name,
            ],
        ];
    }
}
