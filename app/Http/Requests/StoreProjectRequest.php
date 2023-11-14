<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:projects,title|max:255',
            'type_id' => ['nullable', 'exists:types,id'],
            'github_link' => 'required|unique:projects,github_link|max:255',
            'internet_link' => 'unique:projects,internet_link|max:255',
            'description' => 'max:255',
            'thumb' => 'image|max:400',
        ];
    }
}
