<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('customer.write', $this->customer);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes'],
            'email' => ['sometimes', 'email', Rule::unique('customers', 'email')->ignore($this->customer->getKey(), $this->customer->getKeyName()), 'string'],
            'password' => ['sometimes', 'confirmed', 'min:7', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/', 'string'],
            'password_confirmation' => 'sometimes|required_with:password|same:password',
            'shippings' => '',
            'stripe_id' => '',
            'card_brand' => '',
            'card_last_four' => '',
            'trial_ends_at' => '',
        ];
    }

    public function messages()
    {
        return [
            'name.required'          => 'Bitte einen Namen angeben',
            'email.required'         => 'Bitte eine Email-Adresse angeben',
            'email.email'            => 'Das ist keine korrekte Email-Adresse',
            'email.unique'           => 'Diese Email-Adresse wird bereits verwendet',
            'password.min'           => 'Das Passwort muß mindestens :min Zeichen enthalten',
            'password.regex'         => 'Das Passwort ist nicht korrekt',
            'password_confirmation.same:password'   => 'Das Passwort stimmt nicht überein',
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
