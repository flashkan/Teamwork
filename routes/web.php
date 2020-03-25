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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(
    [
        'prefix' => 'product',
        'as' => 'product.',
    ], function () {
    Route::get('/all', 'ProductController@all')->name('all');
    Route::get('/one/{product}', 'ProductController@one')->name('one');
    Route::get('/my', 'ProductController@index')->name('my');
}
);

Route::group(
    [
        'prefix' => 'lot',
        'as' => 'lot.',
    ], function () {
    Route::get('/all', 'LotController@all')->name('all');
    Route::get('/one/{lot}', 'LotController@one')->name('one');
    Route::get('/my', 'LotController@my')->name('my');
}
);
