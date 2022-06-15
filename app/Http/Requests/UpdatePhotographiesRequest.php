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
            'point_of_interest_id' => 'required',
            'order' => 'required',
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
            'point_of_interest_id.required' => 'Debe seleccionar un punto de interés',
            'order.required' => 'El numero de orden de la foto es requerido',
            'thematic_area_id.required' => 'Debe seleccionar un area temática',
            'route.image' => 'La foto debe ser una imagen',
            'route.max' => 'El tamaño maximo de la imagen es de 3 MB',
        ];
    }
}
