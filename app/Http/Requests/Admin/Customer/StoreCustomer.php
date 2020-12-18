<?php
namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StoreCustomer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('customer.write');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('customers', 'email'), 'string'],
            'email_verified_at' => ['nullable', 'date'],
            'password' => ['required', 'confirmed', 'min:7', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/', 'string'],
            'roles' => ['array'],
            'stripe_id' => '',
            'card_brand' => '',
            'card_last_four' => '',
            'trial_ends_at' => '',
        ];
    }

    /**
    * Modify input data
    *
    * @return array
    */
    public function getSanitized(): array
    {
        $data = $this->only(collect($this->rules())->keys()->all());
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $data;
    }
}
