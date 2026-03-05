<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'usuario' => 'required|string|min:3',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'El usuario es obligatorio.',
            'usuario.min' => 'El usuario debe tener al menos 3 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ];
    }
}
