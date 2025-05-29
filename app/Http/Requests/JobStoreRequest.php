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
            'title.required' => __('messages.job_title_required'),
            'salary.required' => __('messages.job_salary_required'),
            'location.required' => __('messages.job_location_required'),
            'schedule.required' => __('messages.job_schedule_required'),
            'schedule.in' => __('messages.job_schedule_invalid'),
            'url.required' => __('messages.job_url_required'),
            'url.active_url' => __('messages.job_url_invalid'),
        ];      
    }
}