<?php
namespace App\Http\Resources\Payment\Stripe;

use App\Helper\MyLang;
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
         * @var CartItem $this
         */
        $shipping = json_decode(json_encode($this->shipping), true);
        return [
            'name'      => $this->name,
            'email'     => $this->email,
            'currency'  => 'eur',
            'shipping'  => $shipping,
            'address'   => $shipping['address'],
            'preferred_locales' => MyLang::getLocale(),
        ];
    }
}
