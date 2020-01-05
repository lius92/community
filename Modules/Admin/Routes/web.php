<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('org')->group(function() {

    //集团
    Route::get('/group/{id}', 'Org\GroupController@get');
    Route::get('/groups', 'Org\GroupController@getList');
    Route::post('/group', 'Org\GroupController@create');
    Route::put('/group', 'Org\GroupController@update');
    Route::delete('/group/{id}', 'Org\GroupController@delete');

    //分公司
    Route::get('/company/{id}', 'Org\CompanyController@get');
    Route::get('/companies', 'Org\CompanyController@getList');
    Route::post('/company', 'Org\CompanyController@create');
    Route::put('/company', 'Org\CompanyController@update');
    Route::delete('/company/{id}', 'Org\CompanyController@delete');

    //项目
    Route::get('/project/{id}', 'Org\ProjectController@get');
    Route::get('/projects', 'Org\ProjectController@getList');
    Route::post('/project', 'Org\ProjectController@create');
    Route::put('/project', 'Org\ProjectController@update');
    Route::delete('/project/{id}', 'Org\ProjectController@delete');

});

Route::prefix('sec')->group(function() {
    Route::get('/user/{id}', 'Sec\UserController@get');
    Route::get('/users', 'Sec\UserController@getList');
    Route::post('/user', 'Sec\UserController@create');
    Route::put('/user', 'Sec\UserController@update');
    Route::delete('/user/{id}', 'Sec\UserController@delete');
});
