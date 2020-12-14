<?php
namespace App\Http\Resources\Payment\Stripe;

use App\Helper\MyLang;
use App\Models\Shipping;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource
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
         * @var Shipping $this
         */
        $language = MyLang::getPrimary();
        return [
            'name'      => $this->customer->name,
            'address'   => [
                'postal_code'   => $this->postcode,
                'city'          => $this->city,
                'line1'         => $this->street,
                'country'       => $this->country->code,
                'state'         => null,
            ],
        ];
    }
}
