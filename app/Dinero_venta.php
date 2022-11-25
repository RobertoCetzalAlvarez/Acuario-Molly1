<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dinero_Venta extends Model
{
    //
    protected $table='dinero_ventas';
    protected $primaryKey='id';

    public $incrementing=false;
    public $timestamps=false;

    public $fillable=[
        'id',
        'fecha',
        'total'
    ];
}