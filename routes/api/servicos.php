<?php

Route::group([
    'prefix' => 'servicos',
    'as' => 'servicos.',
    'middleware' => ['jwt', 'usuario.ativo'],
], function () {
    Route::post('', 'ServicosController@criar');
    Route::get('', 'ServicosController@listar');
    Route::get('tipos', 'ServicosController@tipos');
    Route::get('{id}/exigencia', 'ServicosController@exigencia');
    Route::get('{id}', 'ServicosController@servicos');
    Route::get('{id}/pagamento', 'ServicosController@pagamento');
    Route::get('{id}/protocolo', 'ServicosController@protocolo');
    Route::get('{id}/selos', 'ServicosController@selos');
});
