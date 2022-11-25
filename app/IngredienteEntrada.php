<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredienteEntrada extends Model
{
    //
    protected $table='ingrediente_entrada';
    protected $primaryKey ='folio';
    protected $with=['detalles'];

    public $incrementing=false;
    public $timestamps=false;
 
    protected $fillable=[
    	'fecha_entrada',
    	'num_articulos',
    		];

        public function detalles(){
            return $this->hasMany('App\IngredienteDetalleEntrada', 'folio','folio');
        }
}
