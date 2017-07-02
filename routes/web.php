<?php

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');

Route::group(['prefix' => 'customers'], function () {
    Route::get('', 'Customer\CustomerController@index');
});

Router::group(['prefix' => 'projects'], function () {
    Route::group(['prefix' => 'materials'], function () {
        Route::get('', 'Project\MaterialController@index');
    });
});

Route::group(['prefix' => 'machine-profiles'], function () {
    Route::get('', 'MachineProfile\MachineProfileController@index');
});
