<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredienteDetalleSalida extends Model
{
    //
   protected $tabla='ingrediente_detalle_salidas';
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