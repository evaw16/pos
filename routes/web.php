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
Route::get('/', function(){
  return view('dashboard');
});


Route::get('/barang', 'BarangController@index');
Route::get('/barang/print', 'BarangController@pdf');
Route::get('/barang/create', 'BarangController@create');
Route::post('/barang', 'BarangController@store');
Route::get('/barang/edit/{id_barang}', 'BarangController@edit');
Route::put('/barang/{id}/edit', 'BarangController@update');
Route::delete('/barang/{id}', 'BarangController@destroy');


Route::get('/supplier', 'SupplierController@index');
Route::get('/supplier/create', 'SupplierController@create');
Route::post('/supplier', 'SupplierController@store');
Route::get('/supplier/edit/{id}', 'SupplierController@edit');
Route::put('/supplier/edit/{id}', 'SupplierController@update');
Route::delete('/supplier/{id}', 'SupplierController@destroy');


Route::get('/customer', 'CustomerController@index');
Route::get('/customer/create', 'CustomerController@create');
Route::post('/customer', 'CustomerController@store');
Route::get('/customer/edit/{id}', 'CustomerController@edit');
Route::put('/customer/edit/{id}', 'CustomerController@update');
Route::delete('/customer/{id}', 'CustomerController@destroy');


Route::get('/pembelian', 'PembelianController@index');
Route::get('/pembelian/create/{id}', 'PembelianController@create');
Route::post('/pembelian/barang/', 'PembelianController@tambahBarang');
Route::post('/pembelian', 'PembelianController@store');
Route::get('/pembelian/clear', 'PembelianController@clear');
Route::get('/pembelian/fetch/{id}','PembelianController@fetch')->name('supplier');
Route::get('/pembelian/barang/{id}','PembelianController@barang')->name('barang');

Route::get('/detail_pembelian', 'DetailPembelianController@index');
Route::get('/detail_pembelian/print/{id}', 'DetailPembelianController@pdf');

Route::get('/kartu_stok', 'KartuStokController@index');
Route::get('/kartu_stok/fetch/{id}', 'KartuStokController@fetch');

Route::get('/penjualan', 'PenjualanController@index');
Route::get('/penjualan/create', 'PenjualanController@create');
Route::post('/penjualan', 'PenjualanController@store');
Route::post('/penjualan/barang/', 'PenjualanController@tambahBarang');
Route::get('/penjualan/fetch/{id}', 'PenjualanController@fetch');
Route::get('/penjualan/barang/{id}', 'PenjualanController@barang');
Route::get('/penjualan/detail/{id}', 'PenjualanController@detail_barang');

Route::get('/detail_penjualan', 'DetailPenjualanController@index');
