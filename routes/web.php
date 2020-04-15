<?php

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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Тестовый роут для ajax зпроса
Route::post('/', 'AjaxController@index')->name('ajax');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(
    [
        'prefix' => 'product',
        'as' => 'product.',
        'middleware' => 'auth',
    ], function () {
    Route::get('/all', 'ProductController@all')->name('all');
    Route::get('/one/{product}', 'ProductController@one')->name('one')
        ->middleware('user.owner');
    Route::get('/my', 'ProductController@my')->name('my');
    Route::match(['get', 'post'], '/add', 'ProductController@add')->name('add');
    Route::match(['get', 'post'], '/update/{product}', 'ProductController@update')->name('update')
        ->middleware('user.owner');
    Route::match(['get', 'post'], '/delete/{product}', 'ProductController@delete')->name('delete')
        ->middleware('user.owner');
}
);

Route::group(
    [
        'prefix' => 'lot',
        'as' => 'lot.',
    ], function () {
    Route::get('/all', 'LotController@all')->name('all');
    Route::get('/one/{lot}', 'LotController@one')->name('one')->middleware('closed.lot');
    Route::get('/my', 'LotController@my')->name('my')->middleware('auth');
    Route::match(['get', 'post'], '/add', 'LotController@add')->name('add')
        ->middleware('auth');
    Route::match(['get', 'post'], '/update/{lot}', 'LotController@update')->name('update')
        ->middleware('auth', 'user.owner', 'closed.lot');
    Route::match(['get', 'post'], '/delete/{lot}', 'LotController@delete')->name('delete')
        ->middleware('auth', 'user.owner', 'closed.lot');
}
);

Route::group(
    [
        'prefix' => 'account',
        'as' => 'account.',
        'middleware' => 'auth',
    ], function () {
    Route::get('/my', 'AccountController@my')->name('my');
    Route::post('/increase', 'AccountController@increase')->name('increase');
    Route::post('/decrease', 'AccountController@decrease')->name('decrease');
}
);

Route::group(
    [
        'prefix' => 'bid',
        'as' => 'bid.',
        'middleware' => 'auth',
    ], function () {
    Route::post('/add', 'BidController@add')->name('add');
}
);
