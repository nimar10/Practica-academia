<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumnoRequest extends FormRequest
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

            'nombre' => ['required'],
            'apellidos' => ['required'],
            'mail' => ['required', 'unique:alumnos,mail'],
            'logo' => ['nullable', 'image']

        ];
    }

      /**
     * Get messages of validation´s failured.
     *
     * @return array
     */

    public function messages(){
        return [
            'nombre.required'=>'El campo Nombre es obligatorio',
            'apellidos.required'=>'El campo Apellidos es obligatorio',
            'mail.required'=>'El campo Mail es obligatorio',
            'mail.unique'=>'El campo Mail Ya existe!!!'
        ];
    }
}
