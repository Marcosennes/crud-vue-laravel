<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CidadeRequest extends FormRequest
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
            'nome' => 'required | max:70',
            'estadoId' => 'required | integer',
        ];
    }

    public function messages()
    {
        return [
            'required'  => ':attribute é obrigatório.',
            'max'       => ':attribute deve ter no máximo :max caracteres.',
            'integer'   => ':attribute deve ser um número inteiro.',
        ];
    }
}
