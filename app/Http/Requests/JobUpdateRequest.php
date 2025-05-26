<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        $job = $this->route('job');
        return $job && $this->user()->id === optional($job->employer)->user_id;
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', 'in:Part Time,Full Time'],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable'],
            'featured' => ['nullable'],
        ];
    }
}
