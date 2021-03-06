<?php

namespace App\Http\Requests\Admin\Menu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreMenu extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.menu.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'integer'],
            'menu_item_type_id' => ['nullable', 'integer'],
            'name' => ['required', 'string'],
            'css_class' => '',
            'icon' => ['nullable', 'string'],
            'fa_icon' => ['nullable', 'string'],
            'url' => ['nullable', 'string'],
            'lft' => ['required', 'integer'],
            'rgt' => ['required', 'integer'],
            'lvl' => ['required', 'integer'],
            'api_enabled' => ['required', 'boolean'],
            'is_published' => ['required', 'boolean'],
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
