<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePointsOfInterestRequest extends FormRequest
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
        return [
            'qr' => 'required | max: 150',
            'distance' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'place_id' => 'required',
            'thematicAreas' => 'required',
            'title' => 'required',
            'description' => 'required | max: 200',
        ];
    }

    public function messages()
    {
        return [
            'qr.required' => 'El codigo qr es requerido',
            'qr.max' => 'Tamaño codigo qr invalido. Valor maximo 150',
            'distance.required' => 'La distancia es requerida',
            'latitude.required' => 'La latitud es requerida',
            'longitude.required' => 'La longitud es requerida',
            'place_id.required' => 'Debe seleccionar un lugar',
            'thematicAreas.required' => 'Debe seleccionar al menos una area temática',
            'title.required' => 'El campo titulo debe ser requerido',
            'description.required' => 'El campo lenguaje debe ser requerido',
            'description.max' => 'Tamaño maximo 200 caracteres',
        ];
    }
}
