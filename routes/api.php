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

    Route::group(['prefix' => 'materials'], function () {
        Route::get('/{id}', 'Material\MaterialApiController@show');
        Route::get('', 'Material\MaterialApiController@index');

        Route::post('', 'Material\MaterialApiController@create');
        Route::put('/{id}', 'Material\MaterialApiController@update');
    });

    Route::group(['prefix' => 'machine-profiles'], function () {
        Route::get('/{id}', 'MachineProfile\MachineProfileApiController@show');
        Route::get('', 'MachineProfile\MachineProfileApiController@index');

        Route::post('', 'MachineProfile\MachineProfileApiController@create');
        Route::put('/{id}', 'MachineProfile\MachineProfileApiController@update');
    });

    Route::get('/states', 'Data\StateController@index');
    Route::get('/weights', 'Data\WeightController@index');
    Route::get('/densities', 'Data\DensityController@index');
});
