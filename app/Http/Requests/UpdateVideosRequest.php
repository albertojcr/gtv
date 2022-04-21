<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideosRequest extends FormRequest
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
            'name' => 'required | max: 100',
            'order' => 'required',
            'point_of_interest_id' => 'required',
            'thematic_area_id' => 'required'
        ];

        if($this->has('route')) {
            $rules['route'] = 'mimes:mpeg,mp4,webm | max:100000';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del video es requerido',
            'name.max' => 'Tamaño maximo para el nombre del video es de 100 caracteres',
            'route.mimes' => 'El formato de video debe ser .mp4 o .mpeg o .webm',
            'route.max' => 'Tamaño maximo de video 100 MB',
            'order.required' => 'El campo orden es requerido',
            'point_of_interest_id.required' => 'Debe seleccionar un punto de interés',
            'thematic_area_id' => 'Debe seleccionar un area tematica'
        ];
    }
}
