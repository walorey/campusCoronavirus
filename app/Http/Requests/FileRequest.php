<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'name' => 'required|max:60',
            'modulo' => 'required',
            'archivo' => 'required',
            'descripcion' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Debe ingresar un título',
            'name.max' => 'El título no puede superar los 60 caracteres',
            'modulo.required' => 'Debe asignar un modulo',
            'archivo.required'=>'Debe subir un archivo',
            'descripcion.required' => 'Ingrese detalles',
        ];
    }
}
