<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
   protected $tabla='detalle_ventas';
   protected $primaryKey='id';
   protected $with=['productos'];

   public $incrementing=true;
   public $timestamps=false;

   public $fillable=[
   	'sku',
   	'cantidad',
   	'precio',
   	'total',
   	'folio'
   ];

   public function productos(){
      return $this->belongsTo(Producto::class, 'sku', 'sku');
   }
   
}
