<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\Carrera;
use App\Grupo;
use App\Cuatrimestre;
use App\Persona;

class AlumnoController extends Controller
{
    
    public function Listar(){

        $Alumno = Alumno::with(['persona','cuatrimestre','grupo','carrera'])
            -> get();
        
        return $Alumno;

    }

    public function Buscar($id){

        $Alumno = Alumno::with(['persona','cuatrimestre','grupo','carrera'])
            -> find($id);

        return $Alumno;

    }

    public function Crear(){

        $json = request() -> input('json', true);

        $parametrosArray = json_decode($json, true);

        $validacion = validator() -> make($parametrosArray,[
            'nombre'            =>          'required|string',
            'apellido'          =>          'required|string',
            'edad'              =>          'required|integer',
            'email'             =>          'required|email',
            'Estado'            =>          'required|string',
            'municipio'         =>          'required|string',
            'id_cuatrimestre'   =>          'required',
            'id_carrera'        =>          'required',
            'id_grupo'          =>          'required'
        ]);

        if($validacion -> fails()){

            $respuesta = array(
                'status'             =>         'error',
                'code'               =>         '500',
                'message'            =>         'error de validacion',
                'errors'             =>         $validacion -> errors()
            );

        } else {

            $objCarrera = Carrera::find($parametrosArray['id_carrera']);
            $objGrupo = Grupo::find($parametrosArray['id_grupo']);
            $objCuatrimestre = Cuatrimestre::find($parametrosArray['id_cuatrimestre']);

            $objPersona = new Persona($parametrosArray);
            $objAlumno = new Alumno();

            $objPersona -> reg_status = 1;

            $objPersona -> save();

            $objAlumno -> matricula = $objPersona -> id . strtoupper(str_random(10));

            $objAlumno -> Persona() -> associate($objPersona);
            $objAlumno -> Carrera() -> associate($objCarrera);
            $objAlumno -> Grupo() -> associate($objGrupo);
            $objAlumno -> Cuatrimestre() -> associate($objCuatrimestre);

            $objAlumno -> save();

            $respuesta = array(
                'status'            =>          'success',
                'code'              =>          '200',
                'message'           =>          'Registro creado',
                'docente'           =>          $objAlumno
            );

        }

        return response() -> json($respuesta,$respuesta['code']);

    }

    public function Eliminar(){

        $json = request() -> input('json', null);

        $parametrosArray = json_decode($json);

        $objAlumno = $this -> Buscar($parametrosArray['id']);

        $objAlumno -> reg_status = 0;

        $objAlumno -> save();

        $respuesta = array(
            'status'            =>          'success',
            'code'              =>          '200',
            'message'           =>          'registro eliminado',
            'alumno'            =>          $objAlumno
        );

        return response() -> json($respuesta,$respuesta['code']);

    }

    public function Editar(){

        $json = request() -> input('json', null);

        $parametrosArray = json_decode($json, true);

        $objAlumno = $this -> Buscar($parametrosArray['id']);

        $validacion = validator() -> make($parametrosArray,[
            'nombre'            =>          'required|string',
            'apellido'          =>          'required|string',
            'edad'              =>          'required|integer',
            'email'             =>          'required|email',
            'Estado'            =>          'required|string',
            'municipio'         =>          'required|string'
        ]);

        if($validacion -> fails()){

            $respuesta = array(
                'status'            =>          'error',
                'code'              =>          '500',
                'message'           =>          'Error de validacion',
                'errors'            =>          $validacion -> errors()
            );

        } else {



        }



    }


}
