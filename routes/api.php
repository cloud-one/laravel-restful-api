<?php

Route::group(['prefix' => 'api/v1'], function() {

    // Register
    Route::post('register', 'Auth\RegisterController@register');

    // Login
    Route::post('login', 'Auth\LoginController@authenticate');

    // Refresh Token
    Route::get('refresh', 'Auth\RefreshController@refresh');

    // Rotas protegidas por token
    Route::group(['middleware' => ['jwt.auth', 'throttle:60,1']], function() {

        // Users
        Route::get('me', 'User\UserController@me');
        Route::resource('users', 'User\UserController', ['except' => ['create', 'store', 'edit']]);

        // Posts
        Route::resource('posts', 'Post\PostController', ['except' => ['create', 'edit']]);
    });
});
