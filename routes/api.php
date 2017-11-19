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

Route::namespace('Api\v1')->group(function() {

    Route::prefix('account')->group(function() {
        Route::get('/', 'AccountApiController@account');
    });

    Route::prefix('featured')->group(function() {
        Route::get('/songs', 'FeaturedApiController@songs');
        Route::get('/artists', 'FeaturedApiController@artists');
        Route::get('/albums', 'FeaturedApiController@albums');
    });


});
