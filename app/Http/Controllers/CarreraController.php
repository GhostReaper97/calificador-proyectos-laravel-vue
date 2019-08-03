<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrera;
use App\Alumno;

class CarreraController extends Controller
{
    
    public function Listar(){

        $objCarrera = Carrera::where('reg_status','=',1)
            -> get();

        return $objCarrera;

    }

    public function Buscar($id){

        $objCarrera = Carrera::find($id);

        return $objCarrera;

    }

    public function Crear(){

        $json = request() -> input('json', null);

        $datosArray = json_decode($json, true);

        $validacion = validator() -> make($datosArray,[
            'nombre'            =>          'required|string'
        ]);

        if($validacion -> fails()){

            $respuesta = array(
                'status'            =>          'error',
                'code'              =>          '500',
                'message'           =>          'error de validacion',
                'errors'            =>          $validacion -> errors()
            );

        } else {

            $objCarrera = new Carrera($datosArray);

            $objCarrera -> reg_status = 1;

            $objCarrera -> save();

            $respuesta = array(
                'status'            =>          'success',
                'code'              =>          '200',
                'message'           =>          'carrera creada',
                'carrera'           =>          $objCarrera
            );

        }

        return response() -> json($respuesta,$respuesta['code']);

    }

    public function Actualizar(){

        $json = request() -> input('json', null);

        $datosArray = json_decode($json, true);

        $objCarrera = $this -> Buscar($datosArray['id']);

        $validacion = validator() -> make($datosArray,[
            'nombre'            =>          'required|string'
        ]);

        if($validacion -> fails()){

            $respuesta = array(
                'status'            =>          'error',
                'code'              =>          '500',
                'message'           =>          'error de validacion',
                'errors'            =>          $validacion -> fails()
            );

        } else {

            $objCarrera -> nombre = $datosArray['nombre'];

            $objCarrera -> save();

            $respuesta = array(
                'code'          =>          'success',
                'code'          =>          '200',
                'message'       =>          'carrea editada',
                'carrera'       =>          $objCarrera
            );

        }

        return response() -> json($respuesta,$respuesta['code']);

    }

    public function Eliminar(){

        $json = request() -> input('json', null);

        $datosArray = json_decode($json, true);

        $objCarrera = $this -> Buscar($datosArray['id']);

        $objCarrera -> reg_status = 0;

        $objCarrera -> save();

        $respuesta = array(
            'status'            =>          'success',
            'code'              =>          '200',
            'message'           =>          'carrera eliminada',
            'carrera'           =>          $objCarrera
        );

        return response() -> json($respuesta,$respuesta['code']);

    }

}
