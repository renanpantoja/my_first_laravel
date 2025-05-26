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
            'name.required' => 'The name is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'This email is already in use.',
            'password.required' => 'The password is required.',
            'password.confirmed' => 'The passwords do not match.',
            'employer.required' => 'The employer name is required.',
            'logo.required' => 'The logo upload is required.',
            'logo.max' => 'The image must be at most 2MB.',
            'logo.mimes' => 'The image must be a file of type: png, jpg, or webp.',
        ];        
    }
}
