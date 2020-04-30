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
    Route::get('/one/{product}', 'ProductController@one')->name('one')
        ->middleware('user.owner');
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
        'prefix' => 'balance',
        'as' => 'balance.',
        'middleware' => 'auth',
    ], function () {
    Route::post('/increase', 'BalanceController@increase')->name('increase');
    Route::post('/decrease', 'BalanceController@decrease')->name('decrease');
}
);

Route::group(
    [
        'prefix' => 'bid',
        'as' => 'bid.',
        'middleware' => 'auth',
    ], function () {
    Route::post('/add', 'BidController@add')->name('add');
    Route::post('/delete', 'BidController@delete')->name('delete');
}
);

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'as' => 'admin.',
        'middleware' => ['auth', 'is.admin'],
    ], function () {
    /**Users*/
    Route::get('/user/all', 'AdminController@userAll')->name('user.all');
    Route::get('/user/one/{user}', 'AdminController@userOne')->name('user.one');
    Route::match(['get', 'post'], '/user/add', 'AdminController@userAdd')->name('user.add');
    Route::match(['get', 'post'], '/user/update/{user}', 'AdminController@userUpdate')
        ->name('user.update');
    Route::get('/user/delete/{user}', 'AdminController@userDelete')->name('user.delete');

    /**Products*/
    Route::get('/product/all', 'AdminController@productAll')->name('product.all');
    Route::get('/product/one/{product}', 'AdminController@productOne')->name('product.one');
    Route::match(['get', 'post'], '/product/add', 'AdminController@productAdd')->name('product.add');
    Route::match(['get', 'post'], '/product/update/{product}', 'AdminController@productUpdate')
        ->name('product.update');
    Route::get('/product/delete/{product}', 'AdminController@productDelete')->name('product.delete');

    /**Lots*/
    Route::get('/lot/all', 'AdminController@lotAll')->name('lot.all');
    Route::get('/lot/one/{lot}', 'AdminController@lotOne')->name('lot.one');
    Route::match(['get', 'post'], '/lot/add', 'AdminController@lotAdd')->name('lot.add');
    Route::match(['get', 'post'], '/lot/update/{lot}', 'AdminController@lotUpdate')
        ->name('lot.update');
    Route::get('/lot/delete/{lot}', 'AdminController@lotDelete')->name('lot.delete');
}
);

Route::group(
    [
        'prefix' => 'account',
        'as' => 'account.',
        'middleware' => 'auth',
    ], function () {
    Route::get('/index', 'AccountController@index')->name('index');
    Route::match(['put', 'post'], '/update-pass', 'AccountController@updatePass')->name('update-pass');
}
);
