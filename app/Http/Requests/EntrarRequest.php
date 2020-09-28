<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class EntrarRequest extends BaseRequest
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
            'email_cpf' => 'required',
            'senha' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email_cpf.required' => 'O campo email_cpf é obrigatório.',
            'senha.required' => 'O campo senha é obrigatório.',
        ];
    }
}
