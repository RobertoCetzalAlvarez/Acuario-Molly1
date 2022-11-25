<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comida extends Model
{
    //selecciona la tabla
    protected $table='comidas';
    protected $primaryKey='id_comida';

    public $incrementing=false;
    public $timestamps=false;

    public $fillable=[
        //'id_tipo',
        'tipo',
        'precio',
    ];
}
