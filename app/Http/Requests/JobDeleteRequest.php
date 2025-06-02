<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JobDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        $job = $this->route('job');

        return Auth::check() && $job->employer->user_id === Auth::id();
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [];
    }
}