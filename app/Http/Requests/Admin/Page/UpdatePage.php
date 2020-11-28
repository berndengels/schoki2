<?php

namespace App\Http\Requests\Admin\Page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdatePage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.page.edit', $this->page);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'created_by' => ['sometimes', 'integer'],
            'updated_by' => ['sometimes', 'integer'],
            'title' => ['sometimes', 'string'],
            'slug' => ['sometimes', Rule::unique('page', 'slug')->ignore($this->page->getKey(), $this->page->getKeyName()), 'string'],
            'body' => ['sometimes', 'string'],
            'is_published' => ['sometimes', 'boolean'],
            
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
