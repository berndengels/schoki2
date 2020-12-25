<?php

namespace App\Http\Requests\Admin\Shipping;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateShipping extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function validationData()
    {
        return array_merge([
            'is_default'  => false,
        ], $this->all());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'customer_id'   => '',
            'country_id'    => ['required'],
            'postcode'      => ['required'],
            'city'          => ['required'],
            'street'        => ['required'],
            'is_default'    => ['nullable', 'boolean'],
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();
        $sanitized['customer_id'] = $this->user('web')->id;

        return $sanitized;
    }
}
