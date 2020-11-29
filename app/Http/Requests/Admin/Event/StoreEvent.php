<?php

namespace App\Http\Requests\Admin\Event;

use App\Http\Requests\Admin\ext\HasCategory;
use App\Http\Requests\Admin\ext\HasTheme;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreEvent extends FormRequest
{
    use HasCategory, HasTheme;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.event.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'theme_id' => '',
            'category_id' => ['required'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'event_time' => ['required', 'date_format:H:i:s'],
            'price' => ['nullable', 'decimal'],
            'is_published' => ['required', 'boolean'],
            'links' => ['nullable', 'string'],
            'subtitle' => '',
            'is_periodic' => '',
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
        $sanitized['category_id'] = $this->getCategoryId();
        $sanitized['theme_id'] = $this->getThemeId();

        return $sanitized;
    }
}
