<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredienteDetalleEntrada extends Model
{
    //
   protected $tabla='ingrediente_detalle_entradas';
   protected $primaryKey='id';
   //Relacion con otra tabla
   protected $with=['ingredientes'];

   public $incrementing=false;
   public $timestamps=false;

   public $fillable=[
   	'sku',
   	'cantidad',
   	'folio',
    'nombre'
   ];

   public function ingredientes(){
      return $this->belongsTo(Ingrediente::class, 'sku', 'sku');
   }
   
}
