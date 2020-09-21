<?php

Route::group([
    'prefix' => 'usuario',
    'as' => 'usuario.',
    'middleware' => ['jwt'],
], function () {
    Route::get('{id}', 'UsuarioController@index');
});
