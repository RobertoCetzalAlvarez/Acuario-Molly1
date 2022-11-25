<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Guia extends Model
{
    //
    protected $table='guias';
    protected $primaryKey='id';
    //la clave primaria es cadena de texto
    public $incrementing=false;

    public $timestamps=false;

    protected $fillable=[
        'nombre',
        'celular',
    ];




}
