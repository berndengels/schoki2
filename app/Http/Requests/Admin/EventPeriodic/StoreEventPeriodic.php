<?php

namespace App\Http\Requests\Admin\EventPeriodic;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreEventPeriodic extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('event-periodic.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'theme_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'periodic_position' => ['required', 'string'],
            'periodic_weekday' => ['required', 'string'],
            'created_by' => ['required', 'integer'],
            'updated_by' => ['required', 'integer'],
            'title' => ['required', 'string'],
            'subtitle' => ['required', 'string'],
            'description' => ['required', 'string'],
            'links' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'event_time' => ['required', 'date_format:H:i:s'],
            'price' => ['nullable', 'numeric'],
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
