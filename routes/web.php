<?php

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');

Route::get('/customer', 'Customer\CustomerController@index');

Route::get('/api/customer', 'Customer\CustomerApiController@index');
