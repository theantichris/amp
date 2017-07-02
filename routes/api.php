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

    Route::group(['prefix' => 'projects'], function () {
        Route::group(['prefix' => 'materials'], function () {
            Route::get('/{id}', 'Project\MaterialApiController@show');
            Route::get('', 'Project\MaterialApiController@index');

            Route::post('', 'Project\MaterialApiController@create');
            Route::put('/{id}', 'Project\MaterialApiController@update');
        });

        Route::group(['prefix' => 'parts'], function () {
            Route::get('/{id}', 'Project\PartApiController@show');
            Route::get('', 'Project\PartApiController@index');

            Route::post('', 'Project\PartApiController@create');
            Route::put('/{id}', 'Project\PartApiController@update');
        });
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
