<?php

namespace App\Http\Requests\Admin\Address;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateAddress extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.address.edit', $this->address);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'address_category_id' => ['sometimes', 'integer'],
            'email' => ['sometimes', 'email', Rule::unique('address', 'email')->ignore($this->address->getKey(), $this->address->getKeyName()), 'string'],
            'token' => ['sometimes', Rule::unique('address', 'token')->ignore($this->address->getKey(), $this->address->getKeyName()), 'string'],
            'info_on_changes' => ['sometimes', 'boolean'],
            
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


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
