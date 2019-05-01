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

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', "LoginController@login");

    Route::group(['middleware' => [ 'auth:api']], function () {

        Route::post('/user', function (Request $request) {
            return Auth::user()->token();
        });
        Route::post('logout', "LoginController@logout");

    });
});

Route::get('/', function (Request $request) {
    return response()->json(["status" => "OK"]);
});