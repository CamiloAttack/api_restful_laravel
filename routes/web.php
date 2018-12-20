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

 
 /*

Route::group(['prefix' => 'admin'], function() {

	Route::resource('tipo_media', 'TipoMediaController');
    
 
});

*/


/*
Route::resource('usuario', 'UsuarioController')->middleware('auth');
Route::resource('rol', 'RolController')->middleware('auth');

Route::resource('estatus', 'EstatusController')->middleware('auth');*/

/*
Route::resource('login','Auth\LoginController');
Route::get('logout','Auth\LoginController@logout');*/
Auth::routes();
