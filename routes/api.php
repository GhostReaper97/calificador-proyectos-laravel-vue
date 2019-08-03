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
Route::post('/grupo/update','GrupoController@Actualizar')->name('ActualizarGrupo');

//rutas del catalogo cuatrimestre
Route::get('/cuatrimestre','CuatrimestreController@Listar')->name('ListarCuatrimestre');
Route::get('/cuatrimestre/{id}','CuatrimestreController@Buscar')->name('BuscarCuatrimestre');

Route::post('/cuatrimestre','CuatrimestreController@Crear')->name('CrearCuatrimestre');
Route::post('/cuatrimestre/delete','CuatrimestreController@Eliminar')->name('EliminarCuatrimestre');

Route::get('/materia','MaterialController@Listar')->name('ListarMateria');
Route::get('/materia/{id}','MaterialController@Buscar')->name('BuscarMateria');

Route::post('/materia','MaterialController@Crear')->name('CrearMateria');
Route::post('/materia/delete','MaterialController@Eliminar')->name('EliminarMateria');
Route::post('/materia/update','MaterialController@Actualizar')->name('ActualizarMateria');

Route::get('/docente','DocenteController@Listar')->name('ListarDocente');
Route::get('/docente/{id}','DocenteController@Buscar')->name('BuscarDocente');
Route::get('/docente/persona/{id}','DocenteController@BuscarDocente')->name('BuscarPersonaDocente');
Route::get('/docente/usuario/{id}','DocenteController@ConsultaUsuario');
Route::get('/docente/materias/sin/{id_docente}','MaterialController@ConsultarDocenteSinMaterias');
Route::get('/docente/materias/con/{id}','MaterialController@ConsultarDocenteMaterias');

Route::post('/docente','DocenteController@Crear')->name('CrearDocente');
Route::post('/docente/delete','DocenteController@Eliminar')->name('EliminarDocente');
Route::post('/docente/usuario','DocenteController@CrearUsuario')->name('CrearUsuarioDocente');
Route::post('/docente/materia','MaterialController@AsignarMateriaDocente');

Route::get('/carrera','CarreraController@Listar')->name('ListarCarrera');
Route::get('/carrera/{id}','CarreraController@Buscar')->name('BuscarCarrera');

Route::post('/carrera','CarreraController@Crear')->name('CrearCarrera');
Route::post('/carrera/delete','CarreraController@Eliminar')->name('ElminarCarrera');
Route::post('/carrera/update','CarreraController@Actualizar')->name('ActualizarCarrera');

Route::get('/alumno','AlumnoController@Listar')->name('ListarCarrera');
Route::get('/alumno/{id}','AlumnoController@Buscar')->name('BuscarCarrera');

Route::post('/alumno','AlumnoController@Crear')->name('CrearCarrera');
