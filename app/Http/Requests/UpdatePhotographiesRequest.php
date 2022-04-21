<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotographiesRequest extends FormRequest
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
            'thematic_area_id' => 'required',
        ];

        if($this->has('route')) {
            $rules['route'] = 'image | max: 3072';
        }

        return $rules;
    }

    public function messages()
    {
        return  [
            'name.required' => 'El nombre de la foto es requerido',
            'name.max' => 'Tamaño maximo para el nombre de la foto es de 100 caracteres',
            'route.image' => 'La foto debe ser una imagen',
            'route.max' => 'El tamaño maximo de la imagen es de 3 MB',
            'order.required' => 'El numero de orden de la foto es requerido',
            'point_of_interest_id.required' => 'Debe seleccionar un punto de interés',
            'thematic_area_id.required' => 'Debe seleccionar un area temática'
        ];
    }
}
