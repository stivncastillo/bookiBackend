<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Version 1
 */
Route::group(['namespace' => 'Api', 'as' => 'api.', 'prefix' => 'v1'], function () {
    include_route_files(__DIR__.'/api/v1');
});
