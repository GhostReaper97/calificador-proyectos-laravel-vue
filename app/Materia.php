<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    
    protected $table = "materia";

    protected $fillable = [
        'nombre',
        'reg_status'
    ];

    //relaciones

    /**
     * 
     * Relacion muchos a muchos
     * Materia a docente
     * 
     */
    public function Docente(){

        return $this -> belongsToMany(Docente::class,'id_materia');

    }

}
