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

Route::middleware('auth:api')->get('/admin', function (Request $request) {
    return $request->user();
});

Route::prefix('sec')->group(function() {
    Route::get('/user/{id}', 'Sec\UserController@get')->middleware('check_token');
    Route::get('/users', 'Sec\UserController@getList');
    Route::post('/user', 'Sec\UserController@create');
    Route::put('/user', 'Sec\UserController@update');
    Route::delete('/user/{id}', 'Sec\UserController@delete');
    Route::put('/user/login', 'Sec\UserController@login');
});
