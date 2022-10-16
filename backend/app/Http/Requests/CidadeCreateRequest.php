<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CidadeCreateRequest extends FormRequest
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
            'nome' => 'required|unique:cidade|max:70',
            'estadoId' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'unique'    => ':attribute já existe.',
            'required'  => ':attribute é obrigatório.',
            'estadoId.required'  => 'nenhum estado foi selecionado',
            'max'       => ':attribute deve ter no máximo :max caracteres.',
            'integer'   => ':attribute deve ser um número inteiro.',
        ];
    }
}
