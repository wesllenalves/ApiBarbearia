<?php

Route::group([
    'prefix' => 'empresas',
    'as' => 'empresas.',
    'middleware' => ['jwt', 'usuario.ativo', 'log.atividade'],
], function () {

    /*
     * Empresa
     */
    Route::post('', 'EmpresaController@solicitaCadastro')->name('solicitaCadastro');
    Route::post('{id}/contrato', 'EmpresaController@uploadContrato')->name('uploadContrato');
    Route::get('{id}/contrato', 'EmpresaController@gerarURLContrato')->name('gerarURLContrato');
    Route::get('{id}/contrato-vigente', 'EmpresaController@pegarContratoVigente')->name('pegarContratoVigente');
    route::get('listar', 'EmpresaController@listarEmpresas')->name('ListarEmpresas');
    route::post('listar-select/{id}', 'EmpresaController@listarSelect')->name('ListarSelectEmpresa');

    /*
    * Hash Central
    */
    Route::group(['middleware' => 'dono'], function () {
        Route::get('hash-central', 'EmpresaController@retornarHash')->name('retornarHashCentral');
        Route::post('hash-central/inserir/{id}', 'EmpresaController@inserirHash')->name('inserirHashCentral');
    });
});
