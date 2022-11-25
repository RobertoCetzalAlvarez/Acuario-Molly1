<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table='productos';

    protected $primaryKey='sku';
    //especificamos relaciones
    public $with=['tipo'];

    public $incrementing=false;

    public $timestamps=false;

    protected $fillable=[
    	'nombre',
    	'precio',
    	'cantidad',
        'tipo',
        'id_comida'
    ];
    public function tipo(){

        return $this->belongsTo(Comida::class,'id_comida','id_comida');

    }

}
