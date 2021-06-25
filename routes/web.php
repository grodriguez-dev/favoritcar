<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;

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

Route::get('/', 'App\Http\Controllers\CarController@index')->name('index.index');
Route::post('/cars', 'App\Http\Controllers\CarController@store')->name('cars.store');
Route::get('/cars/{id}', 'App\Http\Controllers\CarController@edit')->name('cars.edit');
Route::post('/cars/{id}', 'App\Http\Controllers\CarController@update')->name('cars.update');
Route::post('/cars/{id}/delete', 'App\Http\Controllers\CarController@destroy')->name('cars.destroy');


Route::resource('brands', BrandController::class);
