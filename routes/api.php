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
Route::group(['prefix' => 'v1'], function(){
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', 'AuthController@login');
        Route::post('/register', 'AuthController@register');
        Route::post('/refresh', 'AuthController@refresh');
    });

    Route::group(['middleware' => 'jwt', 'prefix' => 'auth'], function () {
        Route::post('/logout', 'AuthController@logout');
        Route::get('/user-profile', 'AuthController@userProfile');
    });

    Route::get('/homepage', 'Controller@getHomepage');
    Route::group(['middleware' => 'jwt', 'prefix' => 'generic'], function () {
        Route::get('/app-status', 'Controller@getAppStatus');
    });

    Route::group(['prefix' => 'shops'], function(){
        Route::get('get-map-shops', 'ShopsController@getShopsWithCoordinates');
    });
});
