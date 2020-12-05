<?php

namespace App\Http\Requests\Admin\Event;

use App\Http\Requests\Admin\ext\HasCategory;
use App\Http\Requests\Admin\ext\HasTheme;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateEvent extends FormRequest
{
    use HasCategory, HasTheme;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('event.edit', $this->event);
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
            'is_published' => ['required', 'boolean'],
            'price' => '',
            'links' => '',
            'subtitle' => '',
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
