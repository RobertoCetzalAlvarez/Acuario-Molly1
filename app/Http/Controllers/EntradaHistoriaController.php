<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IngredienteEntrada;
use DB;


class EntradaHistoriaController extends Controller
{
    public function index()
    {
        //
        return $venta = IngredienteEntrada::all();
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
