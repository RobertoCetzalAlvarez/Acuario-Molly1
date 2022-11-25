<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IngredienteSalida;
use DB;


class SalidasHistoriaController extends Controller
{
    public function index()
    {
        //
        return $venta = IngredienteSalida::all();
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
