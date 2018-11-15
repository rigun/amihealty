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

Route::get('/', function () {return view('app');});
Route::get('/login', function () {return view('app');});
Route::get('/dashboard', function () {return view('app');});
Route::get('/logout', function () {return view('app');});
Route::get('/sukses', function () {return view('app');});
Route::get('/profile', function () {return view('app');});
Route::get('/list/{kategori}/{subkategori}', function () {return view('app');});
Route::get('/detaillist/{subkategori}/{slug}', function () {return view('app');});
Route::get('/PostBarang', function () {return view('app');});
Route::get('/bag', function () {return view('app');});
Route::get('/transaksi', function () {return view('app');});
Route::get('/subkategori/{kategori}', function () {return view('app');});
Route::get('/UserList', function () {return view('app');});
