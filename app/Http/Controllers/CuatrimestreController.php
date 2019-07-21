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

}
