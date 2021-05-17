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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/board','BoardController@index');
Route::get('/board/create','BoardController@create');
Route::post('/board','BoardController@store');
Route::get('/board/{row}','BoardController@show');
Route::get('/board/{row}/edit','BoardController@edit');
Route::put('/board/{row}','BoardController@store');
Route::DELETE('board/{row}','BoardController@destroy');
