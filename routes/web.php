<?php

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');

Route::group(['prefix' => 'customers'], function () {
    Route::get('', 'Customer\CustomerController@index');
});

Route::group(['prefix' => 'projects'], function () {
    Route::get('', 'Project\ProjectController@index');

    Route::group(['prefix' => 'materials'], function () {
        Route::get('', 'Project\MaterialController@index');
    });
});

Route::group(['prefix' => 'machine-profiles'], function () {
    Route::get('', 'MachineProfile\MachineProfileController@index');
});
