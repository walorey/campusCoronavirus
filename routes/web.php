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

Route::group(['middleware' => ['auth']], function(){

	//foro
	Route::resource('foro', 'QuestionController');

	//mis preguntas
	Route::get('mis-preguntas', function(){
		return view('foro.misPreguntas');
	})->name('misPreguntas');

	//material didactico
	Route::get('material-didactico', [
		'uses' => 'FileController@indexClientes',
		'as' => 'materialDidactico'
	]);

	//configuracion
	Route::resource('configuracion', 'ConfigController');

	Route::post('/cambiarEmail', [
		'uses' => 'ConfigController@cambiarEmail',
		'as' => 'cambiar.email.config'
	]);

	Route::post('modificarPassword', [
		'uses' => 'ConfigController@cambiarPassword',
		'as' => 'modificar.password.config'
	]);
});

Route::group(['prefix'=>'/admin', 'middleware'=>['admin']], function(){

	Route::get('/' , function(){
		return view('admin.home');
	})->name('admin.home');

	//archivos

	Route::resource('files', 'FileController');

	Route::get('/subirArchivo', [
		'uses' => 'FileController@create',
		'as' => 'subir.archivo'
	]);

	//usuarios

	Route::resource('users', 'UserController');

	//blanquear contraseña

	Route::post('blanquearPassword/{id}', [
		'uses' => 'UserController@blanquearPassword',
		'as' => 'blanquear.password'
	]);

	//comentarios

	Route::resource('comentarios', 'CommentController');

	//comentar

	Route::post('comentar/{id}', [
		'uses' => 'CommentController@store',
		'as' => 'comentar.store'
	]);

});