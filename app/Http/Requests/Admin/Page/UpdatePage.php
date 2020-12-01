<?php

namespace App\Http\Requests\Admin\Page;

use App\Http\Requests\Admin\ext\HasCategory;
use App\Http\Requests\Admin\ext\HasTheme;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdatePage extends FormRequest
{
    use HasCategory, HasTheme;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('page.edit', $this->page);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string'],
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
        $sanitized['category_id'] = $this->getCategoryId();
        $sanitized['theme_id'] = $this->getThemeId();

        return $sanitized;
    }
}
