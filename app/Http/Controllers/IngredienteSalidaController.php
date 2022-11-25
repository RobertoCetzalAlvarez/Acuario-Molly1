<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IngredienteSalida;
use Codedge\Fpdf\Fpdf\Fpdf;
Use App\Ingrediente;
use App\IngredienteDetalleSalida;
      //IngredienteDetalleSalida
use DB;


class IngredienteSalidaController extends Controller
{
    public function index()
    {
        //
        return $productos=Ingrediente::all();

    }
    public function store(Request $r)
    {
        //Seccion del manejo de la entrada
        //return $r;

         $entrada = new IngredienteSalida;

        $entrada->folio=$r->get('folio');
        $entrada->fecha_entrada=$r->get('fecha_entrada');
        $entrada->num_articulos=$r->get('num_articulos');
       

        $entrada->save();

        //Fin de manejo de la ventas

        //Obtenemos del Request el json de los detalles
        $detalles = $r->get('detalles');

        //Insertamos los detalles a la tabla detalle_vemtas
        IngredienteDetalleSalida::insert($detalles);
        //Dinero_Venta::insert($detalles2);
        //Actualizamos el estado de los inventarios
        for ($i=0; $i < count($detalles); $i++) { 

            $cantidadVendida=$detalles[$i]['cantidad'];
            $productoVendido=$detalles[$i]['sku'];

            DB::update("UPDATE ingredientes
                SET cantidad=cantidad-$cantidadVendida
                WHERE sku=$productoVendido");

           
        }
        
    }
    public function show($id)
    {
        //
        return $entrada=IngredienteSalida::find($id);
    }
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    public function ver()
    {
        //
        return $Ingrediente=IngredienteSalida::all();

    }
    
      
}
