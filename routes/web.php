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

Route::group(['middleware' => 'guest'], function () {
    Route::post('/register', 'AuthController@register')->name('register');
    Route::post('/dologin', 'AuthController@dologin')->name('dologin');
    Route::get('/login', 'GeneralController@home')->name('login');
    Route::get('/', 'GeneralController@home');
    Route::post('/confirmguest', 'AdminController@confirmtrans')->name('confirmguest');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/homeadmin', 'AdminController@home')->name('homeadmin');
    Route::get('/listuser', 'AdminController@listuser')->name('listuser');
    Route::get('/listtrans', 'AdminController@listtrans')->name('listtrans');
    Route::get('/listbarang', 'AdminController@listbarang')->name('listbarang');
    Route::get('/listtoko', 'AdminController@listtoko')->name('listtoko');
    Route::post('/konfirmasi', 'AdminController@confirmtrans')->name('konfirmasi');
    Route::get('/logoutadmin', 'AuthController@logout')->name('logoutadmin');
});

Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/home', 'GeneralController@home');
    Route::post('/confirm', 'AdminController@confirmtrans')->name('confirmuser');
    Route::post('/giverating', 'GeneralController@giverating')->name('giverating');
    Route::post('/uploadbukti', 'GeneralController@uploadbukti')->name('uploadbukti');
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/keranjang', 'GeneralController@keranjang')->name('keranjang');
    Route::get('/getbasket', 'GeneralController@getbasket')->name('getbasket');
    Route::post('/addlist', 'GeneralController@addlist')->name('addlist');
    Route::get('/delete/{id}', 'GeneralController@delete')->name('delete');
    Route::post('/additem', 'GeneralController@addItem')->name('addItem');
    Route::post('/minusitem', 'GeneralController@minusItem')->name('minusItem');
    Route::post('/cekbelanjaan', 'GeneralController@cekbelanjaan')->name('cekbelanjaan');
    Route::get('/cekout/{id}', 'GeneralController@cekout')->name('cekout');
    Route::get('/transaksi', 'GeneralController@listtrans')->name('transaksi');
    Route::get('/gettrans', 'GeneralController@gettrans')->name('gettrans');
    Route::post('/detailtrans', 'GeneralController@detailtrans')->name('detailtrans');
    Route::get('/mytoko', 'GeneralController@mytoko')->name('mytoko');
    Route::post('/getbyshop', 'GeneralController@getbyshop')->name('getbyshop');
    Route::post('/createtoko', 'GeneralController@addToko')->name('createtoko');
    Route::post('/addgood', 'GeneralController@addGood')->name('addgood');
});

Route::get('/', 'GeneralController@home')->name('home');
Route::get('/getdata', 'GeneralController@getbarang')->name('getdata');
Route::post('/searchdata', 'GeneralController@searchbarang')->name('searchdata');
Route::get('/getbykategori', 'GeneralController@getbykategori')->name('getbykategori');
Route::get('/detailproduk/{id}', 'GeneralController@detailproduk')->name('detailproduk');
Route::get('/detailtoko/{id}', 'GeneralController@detailtoko')->name('detailtoko');
Route::post('/ratingshop', 'GeneralController@ratingshop')->name('ratingshop');
Route::get('/sendmail', 'AdminController@sendMessage');
Route::get('/errorverify', 'AdminController@verifypage');
Route::get('/verifying/{email}', 'AdminController@verifying');
