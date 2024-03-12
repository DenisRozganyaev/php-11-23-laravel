<?php

namespace App\Http\Requests\Categories;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can(config('permission.permissions.categories.publish'));
    }

    public function messages()
    {
        return [
            'name.min' => 'Should be more than 1 symbol',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:50', 'unique:'.Category::class],
            'parent_id' => ['nullable', 'numeric', 'exists:'.Category::class.',id'],
        ];
    }
}
