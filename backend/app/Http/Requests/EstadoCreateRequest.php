<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadoCreateRequest extends FormRequest
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
            'nome' => 'required|unique:estado|max:70',
            'abreviacao' => 'required|unique:estado|size:2',
        ];
    }

    public function messages()
    {
        return [
            'unique'    => ':attribute já existe.',
            'required'  => ':attribute é obrigatório.',
            'max'       => ':attribute deve ter no máximo :max caracteres.',
            'size'       => ':attribute deve possuir exatamente :size caracteres.',
        ];
    }
}
