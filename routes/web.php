<?php

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');

Route::get('/customers', 'Customer\CustomerController@index');
