<?php

Route::group([
    'prefix' => 'colaborador',
    'as' => 'colaborador.',
    'middleware' => ['jwt', 'usuario.ativo', 'log.atividade'],
], function () {
    /*
     * Colaborador
     */
    Route::group(['middleware' => 'dono'], function () {
        Route::get('/colaborador-vinculados', 'ColaboradorController@lista')->name('listaColaboradorEmpresa');
        Route::post('/colaborador-vinculados/adicionar', 'ColaboradorController@adicionar')->name('adicionarColaboradorEmpresa');
        Route::post('/colaborador-vinculados/{id}', 'ColaboradorController@remover')->name('removerColaboradorEmpresa');
        Route::post('/colaborador-vinculados/reenviar-convite/{id}', 'ColaboradorController@reenviarConvite')->name('reenviarConviteColaboradorEmpresa');
    });
});
