<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    
    protected $table = "persona";

    protected $fillable = [
        'nombre',
        'apellido',
        'edad',
        'email',
        'Estado',
        'municipio',
        'reg_status'
    ];

    //Relaciones de el modelo

    /**
     * 
     * Relacion
     * Persona pertenece a user
     * 
     */

    public function User(){

        return $this -> belongsTo(User::class,'id_user');

    }


    /**
     * 
     * Relacion 
     * Persona es un Docente
     * 
     */

    public function Docente(){

        return $this -> hasOne(Docente::class,'id_persona');

    }

    /**
     * 
     * Relacion
     * Persona s un Alumno
     * 
     */

    public function Alumno(){

        return $this -> hasOne(Alumno::class,'id_persona');

    }

}
