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


//rutas de el catalogo Grupo
Route::get('/grupo','GrupoController@Listar')->name('ListarGrupo');
Route::get('/grupo/{id}','GrupoController@Buscar')->name('BuscarGrupo');

Route::post('/grupo','GrupoController@Crear')->name('CrearGrupo');
Route::post('/grupo/delete','GrupoController@Eliminar')->name('EliminarGrupo');