<?php

// B8ZbJgTlhZIsVz7tAvnls73hP9zX856wAK4r0XGT6fw8338LUj3PksrhYu5b

Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::group(['prefix' => 'customers'], function () {
        Route::get('', 'Customer\CustomerApiController@index');
        Route::post('', 'Customer\CustomerApiController@save');
    });
});
