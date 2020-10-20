<?php

Route::group([
    'prefix' => 'coods',
    'as' => 'usuario.',
    'middleware' => ['jwt'],
], function () {
    Route::get('coordenadas', 'CoordenadasController@index');
});
