<?php

Route::group([
    'prefix' => 'cidade',
    'as' => 'cidade.',
    'middleware' => ['jwt',],
], function () {

    Route::get('', 'CidadeController@buscar')->name('buscar_cidades');
    Route::get('{uf}', 'CidadeController@listar')->name('listar');
});
