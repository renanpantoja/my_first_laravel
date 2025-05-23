<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Só permite editar se o job pertence à empresa do usuário logado
        $job = $this->route('job'); // pega o Job da rota
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
