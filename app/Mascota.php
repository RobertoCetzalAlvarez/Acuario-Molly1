<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    // Nombre de la tabla
    protected $table='mascotas';

    // Clave primaria de la tabla
    protected $primaryKey='id_mascota';

    //Especificamos las relaciones
    public $with=['especie'];

    // La clave primaria es numerica
    public $incrementing=true;

    // Se va utilizar etiquetas de tiempo
    public $timestamps=true;

    // Lista de campos que van a recibir valor
    protected $fillable=[
    'nombre',
    'edad',
    'peso',
    'genero',
    'id_especie',
    'id_propietario'
    ];

    public function especie()
    {
    	return $this->belongsTo(Especie::class,'id_especie','id_especie');
    }


}
