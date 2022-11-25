<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $table='ventas';
    protected $primaryKey ='folio';
    protected $with=['detalles'];

    public $incrementing=false;
    public $timestamps=false;

    protected $fillable=[
    	'folio',
    	'fecha_venta',
    	'num_articulos',
    	'subtotal',
    	'iva',
    	'total',
        'Popina',
        'guia',
        'pago'
    		];

            public function detalles(){
                return $this->hasMany('App\DetalleVenta', 'folio','folio');
            }
}
