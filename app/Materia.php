<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    
    protected $table = "materia";

    protected $fillabel = [
        'nombre',
        'reg_status'
    ];

}
