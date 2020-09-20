<?php

Route::group([
    'prefix' => 'cartorios',
    'as' => 'cartorios.',
    'middleware' => ['jwt', 'usuario.ativo'],
], function () {
    Route::get('', 'CartoriosController@listar');
});
