<?php

Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::group(['prefix' => 'customers'], function () {
        Route::get('/{id}', 'Customer\CustomerApiController@show');
        Route::get('', 'Customer\CustomerApiController@index');

        Route::post('', 'Customer\CustomerApiController@create');
        Route::put('/{id}', 'Customer\CustomerApiController@update');
    });

    Route::get('/states', 'Data\StateController@index');
});
