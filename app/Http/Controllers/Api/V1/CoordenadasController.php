<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Location\Coordinate;
use Location\Distance\Vincenty;
use App\Http\Controllers\Controller;
use App\Models\Usuario;

class CoordenadasController extends Controller
{
    public function index()
    {
        $coordenada1 = new Coordinate( -23.575, -46.658 );
        $coordenada2 = new Coordinate( -21.279, -44.297 );

        $usuario = Usuario::with('endereco')->get();
        return $usuario;

        return $this->pegarCoordenadas($coordenada1, $coordenada2);

    }


    private function pegarCoordenadas($coordenada1, $coordenada2)
    {
        $calculadora = new Vincenty();
        return $calculadora->getDistance($coordenada1, $coordenada2);
    }
}
