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
            'title.required' => 'O título é obrigatório.',
            'salary.required' => 'O salário é obrigatório.',
            'location.required' => 'A localização é obrigatória.',
            'schedule.required' => 'O tipo de trabalho é obrigatório.',
            'schedule.in' => 'O tipo de trabalho deve ser "Part Time" ou "Full Time".',
            'url.required' => 'O campo URL é obrigatório.',
            'url.active_url' => 'A URL fornecida não é válida.',
        ];
    }
}