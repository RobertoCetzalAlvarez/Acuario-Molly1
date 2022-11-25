<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaProducto extends Model
{
    //
    protected $table='entradaproductos';
    protected $primaryKey ='folio';
    protected $with=['detalles'];

    public $incrementing=false;
    public $timestamps=false;
 
    protected $fillable=[
    	'folio',
    	'fecha_entrada',
    	'num_articulos',
    		];

            public function detalles(){
                return $this->hasMany('App\DetalleEntrada', 'folio','folio');
            }
}
