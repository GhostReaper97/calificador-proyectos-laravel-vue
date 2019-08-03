<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docente;
use App\Persona;
use App\User;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{

    public function index(){

        return view('catalogos/docente/docente');

    }

    public function detalle($id){

        return view('catalogos/docente/detalle/detalle',["id" => $id]);

    }

    public function Listar(){

        $Docente = Persona::with('docente')
            -> has('docente')
            -> where('reg_status','=',1)
            -> get();

        return $Docente;

    }

    public function ConsultaUsuario($id){

        $User = Persona::with('user')
            -> find($id);

        return $User;

    }

    public function BuscarDocente($id){

        $Docente = Docente::with('persona')
            -> find($id);

        return $Docente;

    }

    public function CrearUsuario(){

        $Json = request() -> input('json', null);

        $ParametrosArray = json_decode($Json, true);

        $Validacion = validator() -> make($ParametrosArray,[
            'username'          =>          'required|string',
            'password'          =>          'required|string'
        ]);

        if($Validacion -> fails()){

            $Respuesta = array(
                'status'            =>          'error',
                'code'              =>          '500',
                'message'           =>          'error de validacion',
                'errors'            =>          $Validacion -> errors()
            );

        } else {

            $user = new User();
            $Docente = $this -> BuscarDocente($ParametrosArray['id']);

            $user -> name = $ParametrosArray['username'];
            $user -> password = Hash::make($ParametrosArray['password']);
            $user -> perfil = 'docente';
            $user -> email = $Docente -> persona -> email;

            $user -> save();

            $Persona = Persona::find($Docente -> id_persona);

            $Persona -> User() -> associate($user);

            $Persona -> save();

            $Respuesta = array(
                'status'            =>              'success',
                'code'              =>              '200',
                'message'           =>              'usuario creado',
                'user'              =>              $user
            );

        }

        return response() -> json($Respuesta,$Respuesta['code']);

    }

    public function Buscar($id){

        $Docente = Persona::with('docente')
            -> find($id);

        return $Docente;

    }

    public function Eliminar(){

        $json = request() -> input('json', null);

        $ParametrosArray = json_decode($json, true);

        $ObjPersona = $this -> Buscar($ParametrosArray['id']);

        $ObjPersona -> reg_status = 1;

        $ObjPersona -> save();

        $Respuesta = array(
            'status'            =>              'success',
            'code'              =>              '200',
            'message'           =>              'Registro eliminado',
            'docente'           =>              $ObjPersona
        );

        return response() -> json($Respuesta,$Respuesta['code']);

    }

    public function Crear(){

        $json = request() -> input('json', null);

        $ParametrosArray = json_decode($json, true);

        $Validacion = validator() -> make($ParametrosArray,[
            'nombre'            =>          'required|string',
            'apellido'          =>          'required|string',
            'edad'              =>          'required|integer',
            'email'             =>          'required|email',
            'Estado'            =>          'required|string',
            'municipio'         =>          'required|string'
        ]);

        if($Validacion -> fails()){

            $Respuesta = array(
                'status'            =>      'error',
                'code'              =>      '500',
                'message'           =>      'Error de validacion',
                'errors'            =>      $Validacion -> errors()       
            );

        } else {

            $ObjPersona = new Persona($ParametrosArray);
            $ObjDocente = new Docente();

            $ObjPersona -> reg_status = 1;

            $ObjPersona -> save();
    

            $ObjDocente -> matricula = $ObjPersona -> id . strtoupper(str_random(7));

            $ObjDocente -> Persona() -> associate($ObjPersona);

            $ObjDocente -> save();

            $Respuesta = array(
                'status'            =>      'success',
                'code'              =>      '200',
                'message'           =>      'Registro creado',
                'docente'           =>      $ObjDocente      
            );

        }

        return response() -> json($Respuesta,$Respuesta['code']);

    }

}
