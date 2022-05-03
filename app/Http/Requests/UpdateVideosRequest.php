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
            'description' => 'required | max: 100',
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
            'description.required' => 'La descripción del video es requerida',
            'description.max' => 'Tamaño maximo para la descripción del video es de 100 caracteres',
            'route.mimes' => 'El formato de video debe ser .mp4 o .mpeg o .webm',
            'route.max' => 'Tamaño maximo de video 100 MB',
            'order.required' => 'El campo orden es requerido',
            'point_of_interest_id.required' => 'Debe seleccionar un punto de interés',
            'thematic_area_id' => 'Debe seleccionar un area tematica'
        ];
    }
}
