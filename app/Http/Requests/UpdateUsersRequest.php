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
            'name' => 'required',
            'surnames' => 'required',
            'thematic_area_id' => 'not_in:0'
        ];

        if ($this->filled('password')) {
            $rules['password'] = 'confirmed | min:6';
        }
        if ($this->filled('active')) {
            $rules['active'] = 'required';
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
            'name.required' => 'El campo nombre es requerido',
            'surnames.required' => 'El campo apellidos es requerido',
            'active.required' => 'El campo estado del usuario es requerido',
        ];
    }
}
