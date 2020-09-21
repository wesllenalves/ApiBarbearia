<?php

Route::group([
    'namespace' => 'Auth',
    'prefix' => 'auth',
    'as' => 'auth.',
    'middleware' => [],
], function () {
    Route::get('', function () {
        return response()->json('OK auth');
    });

    /*
     * Usuários não autenticados
     */
    /* Route::post('', 'AuthController@entrar')->name('entrar');
    Route::post('cadastrar', 'AuthController@cadastrar')->name('cadastrar');
    Route::get('confirmar', 'AuthController@confirmarEmail')->name('confirmarEmail');
    Route::post('resetar-senha', 'AuthController@resetar')->name('resetar');
    Route::get('resetar-senha', 'AuthController@loginViaToken')->name('loginViaToken');
 */
    /*
    * Usuários autenticados
    */
    /* Route::group(['middleware' => 'jwt'], function () {
        Route::get('sair', 'AuthController@sair')->name('sair');
        Route::put('concluir', 'AuthController@completarCadastro')->name('completarCadastro');
        Route::get('renovar', 'AuthController@renovarTokenJWT')->name('renovarTokenJWT');
        Route::put('alterar-senha', 'AuthController@alterarSenha')->name('alterarSenha');
        Route::get('me', 'AuthController@pegarUsuario')->name('pegarUsuario'); */
        /*
        * Hash de Integração
        */
        /* Route::group(['middleware' => 'dono'], function () {
                Route::get('hash/retorna', 'AuthController@retornaHash')->name('retornaHash');
                Route::get('hash/gerar-hash', 'AuthController@geraHash')->name('gerarHash');
        });
    }); */
});
