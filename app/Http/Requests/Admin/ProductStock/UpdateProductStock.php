<?php

namespace App\Http\Requests\Admin\ProductStock;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateProductStock extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('product-stock.edit', $this->productStock);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id'        => ['required'],
            'product_size_id'   => '',
            'stock'             => ['required', 'integer'],
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
        $sanitized['product_id']        = $sanitized['product_id']['id'];
        if(isset($sanitized['product_size_id'])) {
            $sanitized['product_size_id']   = $sanitized['product_size_id']['id'];
        } else {
            $sanitized['product_size_id'] = null;
        }
        return $sanitized;
    }
}
