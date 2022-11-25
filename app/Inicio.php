<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inicio extends Model
{
    //selecciona la tabla
    protected $table='inicios';
    protected $primaryKey='id';

    public $incrementing=false;
    public $timestamps=false;

    public $fillable=[
        'fecha',
        'cantidad',
    ];
}