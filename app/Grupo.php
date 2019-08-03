<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    
    protected $table = "grupo";

    protected $fillable = [
        'nombre',
        'reg_status'
    ];

    public function Alumno(){

        return $this -> hasMany(Alumno::class,'id_grupo');

    }

}
