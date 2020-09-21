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

            return $this->respondWithToken($token, $usuario);


        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

		return response()->json(['token_expired'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function sair()
    {
        return Auth::logout();
    }

    protected function respondWithToken($token, $usuario = null)
    {
        return [
            'usuario' => $usuario,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
