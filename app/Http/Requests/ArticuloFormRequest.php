<?php

namespace sisKardex\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloFormRequest extends FormRequest
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
        //Reglas colocada para los objetos/campos del formulario HTML, basandonos en los campos que tenemos en nuestra BD
        return [
            'idcategoria'=>'required',
            'codigo'=>'required|max:50',
            'bodega'=>'required|max:50',
            'contenido'=>'required|max:50',
            'nombre'=>'required|max:100',
            'stock'=>'required|numeric',
            'descripcion'=>'max:512',
            'imagen'=>'mimes:jpeg,bmp,png'
        ];
    }
}
