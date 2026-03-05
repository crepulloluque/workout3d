<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'usuario' => 'required|string|min:3|max:20',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|string|min:6|confirmed',
            'edad' => 'nullable|integer|min:10|max:120',
            'peso' => 'nullable|numeric|min:30|max:150',
            'altura' => 'nullable|integer|min:100|max:250',
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'El usuario es obligatorio.',
            'usuario.min' => 'El usuario debe tener al menos 3 caracteres.',
            'email.required' => 'El correo es obligatorio.',
            'email.unique' => 'El correo ya fue registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'edad.integer' => 'La edad debe ser un número.',
            'peso.numeric' => 'El peso debe ser un número.',
            'altura.integer' => 'La altura debe ser un número.',
        ];
    }
}
