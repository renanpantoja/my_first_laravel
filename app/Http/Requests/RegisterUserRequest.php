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
/*                     ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(), */
            ],
            'employer' => ['required'],
            'logo' => ['required', File::types(['png', 'jpg', 'webp', 'svg']), 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'As senhas não coincidem.',
            'employer.required' => 'O nome do empregador é obrigatório.',
            'logo.required' => 'O envio de uma logo é obrigatório.',
            'logo.max' => 'A imagem deve ter no máximo 2MB.',
            'logo.mimes' => 'A imagem deve ser do tipo png, jpg ou webp.',
        ];
    }
}
