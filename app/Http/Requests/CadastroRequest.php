<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class CadastroRequest extends BaseRequest
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
            'senha' => 'required|min:8',
            'email' => 'required|email|unique:usuarios',
        ];
    }

    public function messages()
    {
        return [
            'senha.required' => 'Por favor, informe sua senha.',
            'senha.min' => 'Sua senha deve ter no mínimo 8 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.unique' => 'O email informado já se encontra em uso.',
            'email.email' => 'Informe um email válido.',
        ];
    }
}
