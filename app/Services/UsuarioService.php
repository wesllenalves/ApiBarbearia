<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Exceptions\BusinessException;
use App\Repositories\UsuarioRepository;
use App\Notifications\Auth\{CadastrarUsuario, ResetarSenha};
use Carbon\Carbon;
use App\Http\Autenticador;
use Illuminate\Support\Facades\Auth;

class UsuarioService extends BaseService
{
    protected $repositorio;

    public function __construct(UsuarioRepository $repositorio) {
        $this->repositorio = $repositorio;
    }

    public function cadastrar($usuario)
    {
        $usuario = $this->repositorio->adicionar([
            'name'      => $usuario->name,
            'email'     => $usuario->email,
            'password'  => Hash::make($usuario->password),
            'avatar'    => $usuario->avatar,
            'stars'     => $usuario->stars,
        ]);

        return $usuario;
    }

    /* public function confirmarEmail($token)
    {
        $usuario = $this->repositorio->encontrarPor('token', $token);
        $link_criado = Carbon::parse($usuario->updated_at);
        $link_validade = Carbon::parse($usuario->updated_at)->addHours(2);
        $expirado = now()->greaterThanOrEqualTo($link_validade);

        if ($expirado) {
            throw new BusinessException("Link de confirmação de email expirado.", 500);
        }

        $token = Autenticador::criarToken($usuario->id);
        Auth::login($usuario);

        $usuario->token = Str::random(80);
        $usuario->email_verificado_em = Carbon::now();
        $usuario->save();

        return [
            'usuario' => $usuario,
            'token' => $token,
            'expira_em' => config('jwt.ttl'),
        ];
    }


    public function resetarSenha($cpf_emails)
    {
        $coluna_de_busca = ! ctype_digit($cpf_emails) ? 'email' : 'cpf';
        $usuario = $this->repositorio->encontrarPor($coluna_de_busca, $cpf_emails);
        $usuario->token = Str::random(80);
        $usuario->save();

        $dados = [
            'usuario_id' => $usuario->id,
            'senha' => $usuario->password
        ];

        if ($usuario) {
            $usuario->notify(new ResetarSenha());
        }
    }

    public function alterarSenha($usuario, $senha)
    {
        if (! $usuario) {
            throw new BusinessException("Este link não é mais válido por favor gere um novo.", 410);
        }

        $usuario->token = Str::random(80);
        $usuario->save();

        $dados = [
            'password' => Hash::make($senha)
        ];

        $this->repositorio->atualizar($dados, $usuario->id);
    }

    public function autenticarUsuario($token)
    {
        $usuario = $this->repositorio->encontrarPor('token', $token);
        if (! $usuario) {
            throw new BusinessException("Este link não é mais válido por favor gere um novo.", 410);
        }

        $link_criado = Carbon::parse($usuario->updated_at);
        $link_validade = Carbon::parse($usuario->updated_at)->addMinutes(5);
        $expirado = now()->greaterThanOrEqualTo($link_validade);

        if ($expirado) {
            throw new BusinessException("Link de alterar senha expirado.", 500);
        }


        $usuario->token = Str::random(80);
        $usuario->save();
        $usuario->load('contatoAtual.cidade');
        $usuario->load('empresas', 'empresas.contato:id,cidade_id,endereco,bairro,cep', 'empresas.contato.cidade');

        $empresa = $usuario->empresas->first();
        $empresa_dono = $empresa ? $empresa->pivot->dono : null;
        $empresa_id = $empresa ? $empresa->id : null;
        $token = Autenticador::criarToken($usuario->id, $empresa_id, $empresa_dono);
        return [
            'usuario' => $usuario,
            'token' => $token,
            'expira_em' => config('jwt.ttl'),
        ];
    }

    public function atualizarUsuario($id, $dados) {
        $usuario = $this->repositorio->encontrarPor('id', $id);

        \DB::transaction(function() use($dados, $usuario){

            $usuario->update([
                'nome' => $dados['nome'],
                'cpf' => $dados['cpf'],
            ]);

            $dadosContato = [
                'usuario_id' => $usuario->id,
                'cidade_id' => $dados['cidade_id'],
                'cep' => $dados['cep'],
                'endereco' => $dados['endereco'],
                'complemento' => $dados['complemento'],
                'bairro' => $dados['bairro'],
                'celular' => $dados['celular'],
            ];

            $this->contatoService->pegarOuCriar($dadosContato);
            $usuario->load('contatoAtual.cidade');
        });

        return $usuario;
    }
    public function retornaHash()
    {
        $usuario = Autenticador::usuario();
        return $usuario->autenticacao_hash;
    }

    public function geraHash()
    {
        $usuario = Autenticador::usuario();
        $usuario->autenticacao_hash = Str::random(100);
        $usuario->save();
        $hash = $usuario->makeVisible('autenticacao_hash');
        return $hash->autenticacao_hash;
    } */
}
