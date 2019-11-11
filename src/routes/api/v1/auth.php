<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'prefix'     => 'auth',
    'as'         => 'auth.',
    'namespace'  => 'Auth',
], function () {
    /*
     * These routes require no user to be logged in
     */
    Route::group(['middleware' => 'guest'], function () {
        // Authentication Routes
        Route::post('login', 'LoginController@login')->name('login');
        // Route::post('register', 'RegisterController@register')->name('register');

        // Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email.post');
    });

    // Authenticated routes
    Route::group(['middleware' => 'auth:api'], function () {});
});
