<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuatrimestre;

class CuatrimestreController extends Controller
{
    
    public function index(){

        return view('catalogos/cuatrimestre/cuatrimestre');

    }

    public function Listar(){

        $ObjCuatris = Cuatrimestre::where('reg_status','=',1)
            -> get();

        return $ObjCuatris;

    }

    public function Buscar($id){

        $ObjCuatri = Cuatrimestre::find($id);

        return $ObjCuatri;

    }

    public function Crear(){

        $Json = request() -> input('json', null);

        $ParametrosArray = json_decode($Json, true);

        $Validacion = validator() -> make($ParametrosArray,[
            'nombre'                =>          'required|string'
        ]);

        if($Validacion -> fails()){

            $Respuesta = array(
                'status'            =>      'error',
                'code'              =>      '500',
                'message'           =>      'Error de validacion',
                'errors'            =>      $Validacion -> errors()       
            );

        } else {

            $ObjCuatri = new Cuatrimestre($ParametrosArray);

            $ObjCuatri -> reg_status = 1;

            $ObjCuatri -> save();

            $Respuesta = array(
                'status'            =>          'success',
                'code'              =>          '200',
                'message'           =>          'Registro creado',
                'errors'            =>          $ObjCuatri
            );

        }
        
        return response() -> json($Respuesta,$Respuesta['code']);

    }

    public function Eliminar(){

        $Json = request() -> input ('json', null);

        $ParametrosArray = json_decode($Json,true);

        $ObjCuatri = $this -> Buscar($ParametrosArray['id']);

        $ObjCuatri -> reg_status = 0;

        $ObjCuatri -> save();

        $Respuesta = array(
            'status'                =>          'success',
            'code'                  =>          '200',
            'message'               =>          'Registro eliminado',
            'cuatri'                =>          $ObjCuatri
        );

        return response() -> json($Respuesta,$Respuesta['code']);

    }

}
