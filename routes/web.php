<?php

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');

Route::group(['prefix' => 'customers'], function () {
    Route::get('', 'Customer\CustomerController@index');
});

Route::group(['prefix' => 'materials'], function () {
    Route::get('', 'Material\MaterialController@index');
});
