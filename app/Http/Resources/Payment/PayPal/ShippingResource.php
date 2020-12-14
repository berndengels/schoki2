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
        $language = MyLang::getPrimary();
        return [
            'name'      => $this->customer->name,
            'email'     => $this->customer->email,
            'postcode'  => $this->postcode,
            'city'      => $this->city,
            'street'    => $this->street,
            'country'   => $this->country->$language,
        ];
    }
}
