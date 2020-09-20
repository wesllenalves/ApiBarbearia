<?php

Route::group([
    'prefix' => 'contato',
    'as' => 'contato.',
    'middleware' => ['jwt', 'usuario.ativo', 'log.atividade'],
], function () {

    Route::post('', 'ContatoController@criar')->name('criar');
});
