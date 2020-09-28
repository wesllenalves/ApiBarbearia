<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\UsuarioService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CadastroRequest;

class AuthController extends Controller
{
    protected $servico;
    protected $usuario;

    public function __construct(AuthService $servico, UsuarioService $usuario)
    {
        $this->servico = $servico;
        $this->usuario = $usuario;
    }

    public function cadastrar(CadastroRequest $request)
    {
        $usuario = (Object)[
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),
            'password'  => $request->get('password'),
            'avatar'    => $request->get('avatar'),
            'stars'     => $request->get('stars'),
        ];
        $dados = $this->usuario->cadastrar($usuario);
        return $this->sucesso('Usuario cadastrado com sucesso.', $dados);
    }

    public function entrar(Request $requisicao)
    {
        $dados = $this->servico->entrar($requisicao->get('email_cpf'), $requisicao->get('senha'));
        return $this->sucesso('Login efetuado com sucesso.', $dados);
    }

    public function refreshToken()
    {
        $dados = $this->servico->refresh();
        return $this->sucesso("Token renovado com sucesso." ,$dados);
    }

    public function pegarUsuario()
    {
        return $this->sucesso("Dados do usuário." ,auth()->user());
    }
}
