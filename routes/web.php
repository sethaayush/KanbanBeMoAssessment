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
Auth::routes();

// Update our 'home' route to redirect to /tasks
Route::get('/home', function () {
    return redirect()->route('cards.index');
})->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('cards', 'App\Http\Controllers\CardController@index')->name('cards.index');
    Route::post('cards', 'App\Http\Controllers\CardController@store')->name('cards.store');
    Route::put('cards/sync', 'App\Http\Controllers\CardController@sync')->name('cards.sync');
    Route::put('cards/{card}', 'App\Http\Controllers\CardController@update')->name('cards.update');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('columns', 'App\Http\Controllers\ColumnController@store')->name('columns.store');
    Route::put('columns', 'App\Http\Controllers\ColumnController@update')->name('columns.update');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('cards', 'App\Http\Controllers\CardController@index')->name('cards.index');
    Route::post('cards', 'App\Http\Controllers\CardController@store')->name('cards.store');
    // Important: this needs to be above the /cards/{card} route
    Route::put('cards/sync', 'App\Http\Controllers\CardController@sync')->name('cards.sync');
    Route::put('cards/{card}', 'App\Http\Controllers\CardController@update')->name('cards.update');
});
