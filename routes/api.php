<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('refresh', 'AuthController@refresh');
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('/user/list', 'UserController@index');
    Route::get('/user/detail/', 'UserDetailController@index');
    Route::post('/user/detail/', 'UserDetailController@store');

    Route::post('/slider', 'SliderController@store');
    Route::delete('/slider/{id}', 'SliderController@destroy');

    Route::post('/kategori', 'KategoriController@store');
    Route::patch('/kategori/{id}', 'KategoriController@update');
    Route::delete('/kategori/{id}', 'KategoriController@destroy');

    Route::post('/subkategori', 'SubkategoriController@store');
    Route::patch('/subkategori/{id}', 'SubkategoriController@update');
    Route::delete('/subkategori/{id}', 'SubkategoriController@destroy');

    Route::post('/barang', 'BarangController@store');
    Route::patch('/barang/{id}', 'BarangController@update');
    Route::delete('/barang/{id}', 'BarangController@destroy');
    Route::get('/barang/unique', 'BarangController@apiCheckUnique');
    
    Route::get('/warna', 'WarnaController@index');
    Route::post('/warna', 'WarnaController@store');
    Route::delete('/warna/{id}', 'WarnaController@destroy');

    Route::get('/ukuran', 'UkuranController@index');
    Route::post('/ukuran', 'UkuranController@store');
    Route::delete('/ukuran/{id}', 'UkuranController@destroy');

    Route::get('/bag', 'BagController@index');
    Route::post('/bag', 'BagController@store');
    Route::get('/bag/count', 'BagController@count');
    Route::delete('/bag/{id}', 'BagController@destroy');

});
Route::get('/slider', 'SliderController@index');
Route::get('/barang', 'BarangController@index');
Route::get('/barangdetail/{slug}', 'BarangController@detailBarang');
Route::get('/barang/{kategori}/{subkategori}', 'BarangController@show');
Route::get('/barang/terbaru', 'BarangController@newItem');
Route::get('/barang/rekomendasi', 'BarangController@recomendedItem');
Route::get('/kategori', 'KategoriController@index');
Route::get('/subkategori', 'SubkategoriController@index');
Route::get('/subkategori/{kategori}', 'SubkategoriController@show');
Route::post('/user', 'AuthController@register');


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
