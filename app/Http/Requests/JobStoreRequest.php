<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ou aplique lógica de autorização, se necessário
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable'],
            'featured' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'salary.required' => 'The salary is required.',
            'location.required' => 'The location is required.',
            'schedule.required' => 'The job type is required.',
            'schedule.in' => 'The job type must be either "Part Time" or "Full Time".',
            'url.required' => 'The URL field is required.',
            'url.active_url' => 'The provided URL is not valid.',
        ];        
    }
}