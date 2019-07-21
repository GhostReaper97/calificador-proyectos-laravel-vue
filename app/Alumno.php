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

}
