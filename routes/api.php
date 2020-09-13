<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tickets','APIController@index');

Route::post('/tickets/store','APIController@store');

Route::put('/tickets/{id}','APIController@update');


Route::get('/tickets/show/{id}','APIController@show');

Route::delete('/tickets/{id}','APIController@delete');




Route::get('/users','APIUserController@index');

Route::post('/users/store','APIUserController@store');

Route::put('/users/{id}','APIUserController@update');


Route::get('/users/show/{id}','APIUserController@show');

Route::delete('/users/{id}','APIUserController@delete');
