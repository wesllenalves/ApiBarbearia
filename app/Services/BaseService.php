<?php

namespace App\Services;

abstract class BaseService
{
    protected $repositorio;

    public function todos(array $colunas = ['*'])
    {
        return $this->repositorio->todos($colunas);
    }

    public function paginar($page, $max = 10)
    {
        return $this->repositorio->paginar($page, $max);
    }

    public function encontrar($id, array $colunas = ['*'])
    {
        return $this->repositorio->encontrar($id, $colunas);
    }

    public function encontrarPor($coluna, $valor)
    {
        return $this->repositorio->encontrarPor($coluna, $valor);
    }

    public function adicionar(array $dados)
    {
        return $this->repositorio->adicionar($dados);
    }

    public function atualizar(array $dados, $id)
    {
        return $this->repositorio->atualizar($dados, $id);
    }

    public function excluir($id)
    {
        return $this->repositorio->excluir($id);
    }
}
