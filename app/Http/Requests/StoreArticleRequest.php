<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Atur ke true jika user diperbolehkan mengakses request ini
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100|unique:articles,title',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'content' => 'required|string',
        ];
    }

    /**
     * Custom messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title must be filled',
            'title.max' => 'Title must be less than 100 characters',
            'title.unique' => 'Title already exists, please choose another title',
            'category_id.required' => 'Category must be filled',
            'category_id.exists' => 'Category must be selected from the list',
            'author_id.required' => 'Author must be filled',
            'author_id.exists' => 'Author must be selected from the list',
            'tags.required' => 'Tags must be filled',
            'tags.array' => 'Tags must be an array',
            'tags.*.exists' => 'Each tag must be selected from the list',
            'content.required' => 'Content must be filled',
        ];
    }
}
