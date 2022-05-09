<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'login'=> [
                'required',
                Rule::unique('users')->ignore($this->route('user')->id)
            ],
        ];

        if ($this->filled('password')) {
            $rules['password'] = 'confirmed | min:6';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'login.required' => 'El nombre de usuario es requerido',
            'login.unique' => 'El nombre de usuario ya existe en nuestros registros',
            'password.confirmed' => 'Ambas contraseñas son distintas',
            'password.min' => 'Contraseña corta, debe tener como minimo 6 caracteres',
        ];
    }
}
