<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    
    protected $table = "carrera";

    protected $fillable = [
        'nombre',
        'reg_status'
    ];

    public function Alumno(){

        return $this -> hasMany(Alumno::class,'id_carrera');

    }

}
