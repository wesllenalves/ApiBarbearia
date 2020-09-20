<?php

Route::group([
    'prefix' => 'arquivos',
    'as' => 'arquivos.',
    'middleware' => ['jwt', 'usuario.ativo'],
], function () {
    Route::get('{id}', 'ArquivoController@pegar')->name('pegar');
});
