<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVisitsRequest extends FormRequest
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
            'deviceid' => 'required | max:85',
            'appversion' => 'required | max:45',
            'useragent' => 'required | max:95',
            'hour' => 'required',
            'ssoo' => 'required | max:45',
            'ssooversion' => 'required | max:45',
            'latitude' => 'required',
            'longitude' => 'required',
            'point_of_interest_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'deviceid.required' => 'El campo nombre de dispositivo es requerido',
            'deviceid.max' => 'Tamaño maximo 85 caracteres',
            'appversion.required' => 'El campo version de la app es requerido',
            'appversion.max' => 'Tamaño maximo 45 caracteres',
            'useragent.required' => 'El campo usuario de dispositivo es requerido',
            'useragent.max' => 'Tamaño maximo 95 caracteres',
            'hour.required' => 'El campo hora es requerido',
            'ssoo.required' => 'El campo Sistema Operativo es requerido',
            'ssoo.max' => 'Tamaño maximo 45 caracteres',
            'ssooversion.required' => 'El campo version de sistema operativo es requerido',
            'ssooversion.max' => 'Tamaño maximo 45 caracteres',
            'latitude.required' => 'El campo latitud es requerido',
            'longitude.required' => 'El campo longitud es requerido',
            'point_of_interest_id.required' => 'Debe seleccionar un punto de interés',
        ];
    }
}
