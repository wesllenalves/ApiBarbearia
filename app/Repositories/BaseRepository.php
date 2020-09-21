<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;

abstract class BaseRepository
{
    protected $model;

    public function todos(array $colunas = ['*'])
    {
        return $this->model->get($colunas);
    }

    public function paginar($pagina, $limite = 10)
    {
        Paginator::currentPageResolver(function () use ($pagina) {
            return $pagina;
        });
        return $this->model->paginate($limite);
    }

    public function encontrar($id, array $colunas = ['*'])
    {
        return $this->model->find($id, $colunas);
    }

    public function encontrarExcluido($id, array $colunas = ['*'])
    {
        return $this->model->onlyTrashed()->find($id, $colunas);
    }

    public function encontrarPor($coluna, $valor)
    {
        return $this->model->where($coluna, $valor)->first();
    }

    public function adicionar(array $dados)
    {
        return $this->model->create($dados);
    }

    public function atualizar(array $dados, $id)
    {
        return $this->encontrar($id)->update($dados);
    }

    public function excluir($id)
    {
        return $this->model->destroy($id);
    }
}
