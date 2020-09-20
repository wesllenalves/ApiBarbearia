<?php

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'cartorios.',
    'middleware' => ['jwt', 'usuario.ativo', 'admin'],
], function () {

    Route::get('cartorios', 'CartoriosController@listar');
    Route::post('cartorios/importar', 'CartoriosController@importarCSV');
    Route::put('cartorios/{id}', 'CartoriosController@editarCartorio');

    Route::get('empresas', 'EmpresaController@listar');
    Route::put('empresas/{id}/status', 'EmpresaController@status')->middleware('analise.empresa');

    Route::get('tipo-servico','TipoServicoController@listar');
    Route::post('tiposervico/adicionar', 'TipoServicoController@adicionar');
    Route::put('tiposervico/{id}', 'TipoServicoController@editar');
    Route::put('tiposervico/status/{id}', 'TipoServicoController@editarStatus');

});
