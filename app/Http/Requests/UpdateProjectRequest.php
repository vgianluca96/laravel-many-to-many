<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'title' => ['required', Rule::unique('projects')->ignore($this->project), 'max:255'],
            'type_id' => ['nullable', 'exists:types,id'],
            'github_link' => ['required', Rule::unique('projects')->ignore($this->project), 'max:255'],
            'internet_link' => [Rule::unique('projects')->ignore($this->project), 'max:255'],
            'description' => 'max:255',
            'thumb' => 'image|max:400',
        ];
    }
}
