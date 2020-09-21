<?php

namespace App\Services;

use App\Models\Usuario;
use App\Jobs\LogAtividadeJob;
use App\Notifications\Auth\CadastrarUsuario;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Exceptions\BusinessException;
use App\Http\Autenticador;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\BeforeValidException;

class AuthService extends BaseService
{
    public function entrar($email_cpf, $password)
    {
        try {
            if (strpos($email_cpf, '@') AND strlen ($password) != 100) {
                $credenciais =  ['email' => $email_cpf, 'password' => $password];

            } elseif(is_numeric($email_cpf) AND strlen ($password) != 100) {
                $credenciais =  ['cpf' => $email_cpf, 'password' => $password];

            }

            if (! $token = auth()->attempt($credenciais)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $usuario = auth()->user();



            return [
                'usuario'   => $usuario,
                'token'     => $token,
                'expira_em' => config('jwt.ttl'),
            ];
        }  catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

		return response()->json(['token_expired'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
    }


    public function renovarTokenJWT()
    {
        try {
            $usuario = Autenticador::usuario();
            $usuario->load('contatoAtual.cidade');
            if($usuario->ultima_empresa_logada_id === null){
                $usuario->load('empresas', 'empresas.contato:id,cidade_id,endereco,bairro,cep', 'empresas.contato.cidade');
                $empresa = $usuario->empresas->first();
            }else{
                $usuario->load(['empresas' => function($query) use($usuario){
                    return $query->where('id', $usuario->ultima_empresa_logada_id);
                }, 'empresas.contato:id,cidade_id,endereco,bairro,cep', 'empresas.contato.cidade']);
                $empresa = $usuario->empresas->find($usuario->ultima_empresa_logada_id);
            }

            $empresa_dono = $empresa ? $empresa->pivot->dono : null;
            $empresa_id = $empresa ? $empresa->id : null;

            return [
                'usuario' => $usuario,
                'token' => Autenticador::criarToken($usuario->id, $empresa_id, $empresa_dono),
                'expira_em' => config('jwt.ttl'),
            ];
        } catch (BeforeValidException $e) {
            throw new BusinessException("Falha ao gerar novo token.", 500);
        }
    }

    public function sair()
    {
        return Auth::logout();
    }
}
