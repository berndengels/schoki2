<?php
namespace App\Http\Resources\Payment\Stripe;

use App\Helper\MyLang;
use App\Models\Customer;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Request;

class CustomerResource extends JsonResource
{
    public function __construct($resource, $address = null)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var Customer $this
         */
        $shipping = $this->shipping;

        return [
            'name'      => $this->name,
            'email'     => $this->email,
            'shipping'  => [
                'name'  => $this->name,
                'address' => [
                    'line1'     => $shipping->street,
                    'city'      => $shipping->city,
                    'country'   => $shipping->country->code,
                    'postal_code'   => $shipping->postcode,
                ],
            ],
            'address'   => [
                'line1'     => $shipping->street,
                'city'      => $shipping->city,
                'country'   => $shipping->country->code,
                'postal_code'   => $shipping->postcode,
            ],
            'preferred_locales' => [MyLang::getLocaleRfc5646()],
        ];
    }
}
