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

Route::get('/prueba','HomeController@Prueba');

Route::get('/grupo','GrupoController@index')->name('CatalogoGrupo');

Route::get('/cuatrimestre','CuatrimestreController@index')->name('CatalogoCuatrimestre');

Route::get('/materia','MaterialController@index')->name('CatalogoMateria');

Route::get('/docente','DocenteController@index')->name('CatalogoDocente');
Route::get('/docente/detalle/{id}','DocenteController@detalle')->name('DetalleDocente');