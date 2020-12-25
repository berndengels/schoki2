<?php
namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\Shipping\UpdateShipping;

class ShippingRequest extends UpdateShipping
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('customer.write', $this->customer);
    }

    public function messages()
    {
        return [
            'country_id.required'    => 'Bitte ein Land angeben',
            'postcode.required'      => 'Bitte eine Postleitzahl angeben',
            'city.required'          => 'Bitte einen Ort/Stadt angeben',
            'street.required'        => 'Bitte eine Straße mit Hausnummer angeben',
        ];
    }
}
