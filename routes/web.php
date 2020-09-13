<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Route::get('/tickets','Ticketcontroller@index');

Route::get('/tickets/create','Ticketcontroller@create');
Route::post('/tickets/add','Ticketcontroller@add')->name('tickets.add');
Route::get('/tickets/edit/{id}','Ticketcontroller@edit')->name('tickets.edit');
Route::post('/tickets/update/{id}','Ticketcontroller@update')->name('tickets.update');

Route::get('/tickets/show/{id}','Ticketcontroller@show')->name('tickets.show');

