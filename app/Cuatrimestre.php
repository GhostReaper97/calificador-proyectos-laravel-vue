<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuatrimestre extends Model
{
    
    protected $table = "cuatrimestre";

    protected $fillable = [
        'nombre',
        'reg_status'
    ];

    public function Alumno(){

        return $this -> hasMany(Alumno::class,'id_cuatrimestre');

    }

}
