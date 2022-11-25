<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    //
    protected $table='ingredientes';
    protected $primaryKey='sku';
//especificamos relaciones
    public $with=['tipo'];

//la clave primaria es cadena de texto
    public $incrementing=false;

    public $timestamps=false;

    protected $fillable=[
        'nombre',
        'tipo',
        'cantidad',
        'id_tipo'
    ];

    public function tipo(){

        return $this->belongsTo(Tipo::class,'id_tipo','id_tipo');

    }

}
