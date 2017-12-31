<?php

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('', 'User\UserApiController@index');
        Route::get('/{id}', 'User\UserApiController@show');
    });

    Route::group(['prefix' => 'customers'], function () {
        Route::get('/{id}', 'Customer\CustomerApiController@show');
        Route::get('', 'Customer\CustomerApiController@index');

        Route::post('', 'Customer\CustomerApiController@create');
        Route::put('/{id}', 'Customer\CustomerApiController@update');
    });

    Route::group(['prefix' => 'projects'], function () {
        Route::group(['prefix' => 'materials'], function () {
            Route::get('/{id}', 'Project\Material\MaterialApiController@show');
            Route::get('', 'Project\Material\MaterialApiController@index');

            Route::post('', 'Project\Material\MaterialApiController@create');
            Route::put('/{id}', 'Project\Material\MaterialApiController@update');
        });

        Route::group(['prefix' => '{projectId}/comments'], function () {
            Route::get('', 'Project\Comment\CommentApiController@index');
            Route::post('', 'Project\Comment\CommentApiController@create');
        });

        Route::get('/{id}', 'Project\ProjectApiController@show');
        Route::get('', 'Project\ProjectApiController@index');

        Route::post('', 'Project\ProjectApiController@create');
        Route::put('/{id}', 'Project\ProjectApiController@update');

    });

    Route::group(['prefix' => 'machine-profiles'], function () {
        Route::get('/{id}', 'MachineProfile\MachineProfileApiController@show');
        Route::get('', 'MachineProfile\MachineProfileApiController@index');

        Route::post('', 'MachineProfile\MachineProfileApiController@create');
        Route::put('/{id}', 'MachineProfile\MachineProfileApiController@update');
    });

    Route::get('/states', 'Data\StateApiController@index');
    Route::get('/weights', 'Data\WeightApiController@index');
    Route::get('/densities', 'Data\DensityApiController@index');
});
