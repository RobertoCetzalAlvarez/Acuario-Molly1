<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EntradaProducto;
use Codedge\Fpdf\Fpdf\Fpdf;
      //DetalleEntrada
use DB;


class ProductoEntradaController extends Controller
{
    public function index()
    {
        //
        return $producto=EntradaProducto::all();
    }
    public function store(Request $r)
    {
       
    }
    public function show($id)
    {

    }
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    
    
      
}
