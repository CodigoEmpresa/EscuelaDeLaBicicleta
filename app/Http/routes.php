<?php
session_start();
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/personas', '\Idrd\Usuarios\Controllers\PersonaController@index');
Route::get('/personas/service/obtener/{id}', '\Idrd\Usuarios\Controllers\PersonaController@obtener');
Route::get('/personas/service/buscar/{key}', '\Idrd\Usuarios\Controllers\PersonaController@buscar');
Route::get('/personas/service/ciudad/{id_pais}', '\Idrd\Usuarios\Controllers\LocalizacionController@buscarCiudades');
Route::post('/personas/service/procesar/', '\Idrd\Usuarios\Controllers\PersonaController@procesar');


Route::group(['middleware' => ['web']], function () {
    Route::any('/', 'MainController@index');
    Route::get('/welcome', 'MainController@welcome');
    Route::any('/logout', 'MainController@logout');
    Route::get('/certificado', 'CertificadoController@index');
    Route::post('/certificado', 'CertificadoController@generar');
});

//rutas con filtro de autenticación
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::any('/reportes', 'MainController@reporte');
    Route::any('/fecha_reporte', 'MainController@fecha_reporte');
	Route::get('/promotores', 'PromotorController@index');
	Route::get('/promotores/crear', 'PromotorController@crear');
	Route::get('/promotores/{id}/editar', 'PromotorController@editar');
	Route::post('/promotores/procesar', 'PromotorController@procesar');

	Route::any('/jornadas', 'JornadaController@index');
	Route::any('/jornadas/formulario/{id_jornada?}', 'JornadaController@formulario');
	Route::post('/jornadas/procesar', 'JornadaController@procesar');
	Route::post('/jornadas/consultarUsuario', 'JornadaController@consultarUsuario');
});