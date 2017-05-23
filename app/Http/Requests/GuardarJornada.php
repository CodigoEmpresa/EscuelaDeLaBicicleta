<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GuardarJornada extends Request
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
            'Fecha' => 'required',
            'Id_Parque' => 'required',
            'Clima' => 'required',
            'Nombre_Encargado' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'Fecha.required' => 'El campo fecha es requerido',
            'Id_Parque.required' => 'El campo parque es requerido',
            'Clima.required' => 'El campo clima es requerido',
            'Nombre_Encargado.required' => 'El campo encargado es requerido'
        ];
    }
}
