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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function(){
    Route::get('/buku', 'BukuController@index')->name('buku.index');
    Route::get('tambah/buku', 'BukuController@create')->name('buku.create');
    Route::post('simpan/buku', 'BukuController@store')->name('buku.store');

    Route::get('edit/buku/{id}', 'BukuController@edit')->name('buku.edit');
    Route::post('update/buku/{id}', 'BukuController@update')->name('buku.update');

    Route::get('destroy/buku/{id}', 'BukuController@destroy')->name('buku.destroy');
});
