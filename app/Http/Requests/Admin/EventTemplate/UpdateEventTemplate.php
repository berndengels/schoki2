<?php

namespace App\Http\Requests\Admin\EventTemplate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateEventTemplate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('event-template.edit', $this->eventTemplate);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'theme_id' => ['sometimes', 'integer'],
            'category_id' => ['sometimes', 'integer'],
            'created_by' => ['sometimes', 'integer'],
            'updated_by' => ['sometimes', 'integer'],
            'title' => ['sometimes', 'string'],
            'subtitle' => ['sometimes', 'string'],
            'description' => ['sometimes', 'string'],
            'links' => ['sometimes', 'string'],

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
