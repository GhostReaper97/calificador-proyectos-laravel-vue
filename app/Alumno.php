<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    
    protected $table = "alumno";

    protected $fillable = [
        'matricula'
    ];

    /**
     * 
     * Relacion
     * Alumno pertenece a Persona
     * 
     */

    public function Persona(){

        return $this -> belongsTo(Persona::class,'id_persona');

    }

    public function Carrera(){

        return $this -> belongsTo(Carrera::class,'id_carrera');

    }

    public function Grupo(){

        return $this -> belongsTo(Grupo::class,'id_grupo');

    }

    public function Cuatrimestre(){

        return $this -> belongsTo(Cuatrimestre::class,'id_cuatrimestre');   

    }


}
