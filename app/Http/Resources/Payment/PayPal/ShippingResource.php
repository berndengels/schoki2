<?php
namespace App\Http\Resources\Payment\PayPal;

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
        return [
//            'name'      => $this->customer->name,
//            'email'     => $this->customer->email,
            'postal_code'       => $this->postcode,
            'admin_area_2'      => $this->city,
            'address_line_1'    => $this->street,
            'country_code'      => $this->country->code,
        ];
    }
}
