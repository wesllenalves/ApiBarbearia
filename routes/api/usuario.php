<?php

Route::group([
    'prefix' => 'usuario',
    'as' => 'usuario.',
    'middleware' => ['jwt', 'usuario.ativo'],
], function () {
    Route::put('{id}', 'UsuarioController@atualizarUsuario');
});
