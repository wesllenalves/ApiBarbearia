<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository extends BaseRepository
{
    protected $model;

    public function __construct(Usuario $model)
    {
        $this->model = $model;
    }
}
