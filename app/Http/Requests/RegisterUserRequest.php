<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'employer' => ['required'],
            'logo' => ['required', File::types(['png', 'jpg', 'webp', 'svg']), 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('messages.register_name_required'),
            'email.required' => __('messages.register_email_required'),
            'email.email' => __('messages.register_email_invalid'),
            'email.unique' => __('messages.register_email_unique'),
            'password.required' => __('messages.register_password_required'),
            'password.confirmed' => __('messages.register_password_mismatch'),
            'employer.required' => __('messages.register_employer_required'),
            'logo.required' => __('messages.register_logo_required'),
            'logo.max' => __('messages.register_logo_max'),
            'logo.mimes' => __('messages.register_logo_mimes'),
        ];
    }
}
