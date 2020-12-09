<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/refresh', 'AuthController@refresh');
});

Route::group(['middleware' => 'jwt', 'prefix' => 'auth'], function () {
    Route::post('/logout', 'AuthController@logout');
    Route::get('/user-profile', 'AuthController@userProfile');
});

Route::group(['middleware' => 'jwt', 'prefix' => 'generic'], function () {
    Route::get('/app-status', 'Controller@getAppStatus');
});
Route::get('/banners', 'Controller@getBanners');

