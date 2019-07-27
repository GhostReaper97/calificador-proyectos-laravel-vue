<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    
    protected $table = "docente";

    protected $fillable = [
        'matricula'
    ];

    /**
     * 
     * Relacion
     * Docenete pertenece a Persona
     * 
     */

    public function Persona(){

        return $this -> belongsTo(Persona::class,'id_persona');

    }

    /**
     * 
     * Realcion : muchos a muchos
     * Docente a Materia
     * 
     */
    public function Materia(){

        return $this -> belongsToMany(Materia::class,'id_docente');

    }


}
