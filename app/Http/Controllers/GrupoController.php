<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;

class GrupoController extends Controller
{

    //funciones de vista
    
    public function index(){

        return view('catalogos/grupo/grupo');

    }

    //funciones de api

    public function Listar(){

        $ObjGrupos = Grupo::where('reg_status','=', 1)
            -> get();

        return $ObjGrupos;

    }

    public function Buscar($id){

        $ObjGrupos = Grupo::find($id);

        return $ObjGrupos;

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

            $ObjGrupo = new Grupo($ParametrosArray);

            $ObjGrupo -> reg_status = 1;

            $ObjGrupo -> save();

            $Respuesta = array(
                'status'            =>          'success',
                'code'              =>          '200',
                'message'           =>          'Registro Guardado',
                'grupo'             =>          $ObjGrupo
            );

        }

        return response() -> json($Respuesta,$Respuesta['code']);

    }

    public function Eliminar(){

        $Json = request() -> input('json', null);

        $ParametrosArray = json_decode($Json, true);

        $ObjGrupo = $this -> Buscar($ParametrosArray['id']);

        $ObjGrupo -> reg_status = 0;

        $ObjGrupo -> save();

        $Respuesta = array(
            'status'            =>          'success',
            'code'              =>          '200',
            'message'           =>          'Registro eliminado',
            'grupo'             =>          $ObjGrupo
        );

        return response() -> json($Respuesta,$Respuesta['code']);

    }


}
