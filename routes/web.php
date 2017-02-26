<?php

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');

Route::group(['prefix' => 'customers'], function () {
    Route::get('', 'Customer\CustomerController@index');
    Route::get('add', 'Customer\CustomerController@create');
});
