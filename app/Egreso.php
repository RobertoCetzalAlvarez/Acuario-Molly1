<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    //selecciona la tabla
    protected $table='egresos';
    protected $primaryKey='id';

    public $incrementing=false;
    public $timestamps=false;

    public $fillable=[
        'fecha',
        'producto',
        'costo',
        'cantidad',
    ];
}