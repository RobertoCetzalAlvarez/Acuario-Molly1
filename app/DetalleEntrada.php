<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleEntrada extends Model
{
    //
   protected $tabla='detalle_entradas';
   protected $primaryKey='id';
   //Relacion con otra tabla
   protected $with=['productos'];

   public $incrementing=false;
   public $timestamps=false;

   public $fillable=[
   	'sku',
   	'cantidad',
   	'folio'
   ];

   public function productos(){
      return $this->belongsTo(Producto::class, 'sku', 'sku');
   }
   
}
