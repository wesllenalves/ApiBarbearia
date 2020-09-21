<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function erro($mensagem, $codigo = 500, $dados = null)
    {
        return $this->json([
            'erro' => $mensagem,
            'dados' => $dados
        ], $codigo);
    }

    protected function sucesso($mensagem, $dados = null)
    {
        return $this->json([
            'mensagem' => $mensagem,
            'dados' => $dados
        ], 200);
    }

    protected function json($dados, $codigo = 200, $opcoes = [])
    {
        return response()->json($dados, $codigo, $opcoes, JSON_UNESCAPED_UNICODE);
    }
}
