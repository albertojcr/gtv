<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoItemsRequest extends FormRequest
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
            'quality' => 'required | max: 45',
            'format' => 'required | max: 45',
            'orientation' => 'required | max: 100',
            'language' => 'required | max: 5'
        ];
    }

    public function messages()
    {
        return [
            'quality.required' => 'El campo calidad debe ser requerido',
            'quality.max' => 'Tamaño maximo 45 caracteres',
            'format.required' => 'El campo formato debe ser requerido',
            'format.max' => 'Tamaño maximo 45 caracteres',
            'orientation.required' => 'El campo orientacion debe ser requerido',
            'orientation.max' => 'Tamaño maximo 100 caracteres',
            'language.required' => 'El campo lenguaje debe ser requerido',
            'language.max' => 'Tamaño maximo 5 caracteres',
        ];
    }
}
