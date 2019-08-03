<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use App\Docente;
use Illuminate\Database\Eloquent\Builder;

class MaterialController extends Controller
{
    
    public function index(){

        return view('catalogos/materia/materia');

    }

    public function Listar(){

        $Materias = Materia::where('reg_status','=',1)
            -> get();

        return $Materias;

    }

    public function ConsultarDocenteMaterias($id){

        $Materias = Docente::find($id)
            -> Materia()
            -> get();

        return $Materias;

    }

    public function ConsultarDocenteSinMaterias($id_docente){

        $Materias = Materia::whereDoesntHave('docente', function(Builder $query) use ($id_docente) {

            $query -> where('id','=', $id_docente);

        })
            -> where('reg_status','=',1)
            -> with('docente')
            -> get();
        
        return $Materias;

    }

    public function AsignarMateriaDocente(){

        $json = request() -> input('json', null);

        $ParametrosArray = json_decode($json, true);

        $Docente = Docente::find($ParametrosArray['id_docente']);
        $Materia = Materia::find($ParametrosArray['id_materia']);

        $Docente -> Materia() -> attach($Materia,['id_materia' => $Materia -> id]);

        $Respuesta = array(
            'status'            =>          'success',
            'code'              =>          '200',
            'message'           =>          'Materia asignada',
            'docente'           =>          $Docente
        );

        return response() -> json($Respuesta,$Respuesta['code']);

    }
    

    public function Buscar($id){

        $ObjMateria = Materia::find($id);
        
        return $ObjMateria;

    }

    public function Crear(){

        $Json = request() -> input('json', null);

        $ParametrosArray = json_decode($Json, true);

        $Validacion = validator() -> make($ParametrosArray,[
            'nombre'            =>          'required|string'
        ]);

        if($Validacion -> fails()){

            $Respuesta = array(
                'status'            =>      'error',
                'code'              =>      '500',
                'message'           =>      'Error de validacion',
                'errors'            =>      $Validacion -> errors()       
            );

        } else {

            $ObjMateria = new Materia($ParametrosArray);

            $ObjMateria -> reg_status = 1;

            $ObjMateria -> save();

            $Respuesta = array(
                'status'            =>          'success',
                'code'              =>          '200',
                'message'           =>          'Registro Guardado',
                'materia'             =>          $ObjMateria
            );

        }

        return response() -> json($Respuesta,$Respuesta['code']);
        
    }

    public function Actualizar(){

        $Json = request() -> input('json', null);

        $ParametrosArray = json_decode($Json, true);

        $ObjMateria = $this -> Buscar($ParametrosArray['id']);

        $Validacion = validator() -> make($ParametrosArray,[
            'nombre'            =>          'required|string'
        ]);

        if($Validacion -> fails()){

            $Respuesta = array(
                'status'            =>      'error',
                'code'              =>      '500',
                'message'           =>      'Error de validacion',
                'errors'            =>      $Validacion -> errors()       
            );

        } else {

            $ObjMateria -> nombre = $ParametrosArray['nombre'];
            
            $ObjMateria -> save();

            $Respuesta = array(
                'status'            =>          'success',
                'code'              =>          '200',
                'message'           =>          'Registro Actualizado',
                'materia'             =>          $ObjMateria
            );

        }

        return response() -> json($Respuesta,$Respuesta['code']);

    }

    public function Eliminar(){

        $Json = request() -> input('json', null);

        $ParametrosArray = json_decode($Json, true);

        $ObjMateria = $this -> Buscar($ParametrosArray['id']);

        $ObjMateria -> reg_status = 0;

        $ObjMateria -> save();

        $Respuesta = array(
            'status'            =>          'success',
            'code'              =>          '200',
            'message'           =>          'Registro eliminado',
            'materia'             =>          $ObjMateria
        );

        return response() -> json($Respuesta,$Respuesta['code']);

    }

}
