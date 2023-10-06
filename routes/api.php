<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Order\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group([
    'middleware' => 'api',
    'prefix' => 'order'
], function ($router) {
    Route::post('add', 'App\Http\Controllers\Order\OrderController@store');
    Route::get('list', 'App\Http\Controllers\Order\OrderController@index');
    Route::get('show/{id}', 'App\Http\Controllers\Order\OrderController@show');
    Route::put('update/{id}', 'App\Http\Controllers\Order\OrderController@update');
    Route::delete('delete/{id}', 'App\Http\Controllers\Order\OrderController@destroy');
});