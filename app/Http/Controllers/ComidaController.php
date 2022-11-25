<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comida;

class ComidaController extends Controller
{
    public function index()
    {
        //
        return $comida=Comida::all();
    }
    public function store(Request $request)
    {
        //
        $comida=new Comida();
        $comida->tipo=$request->get('tipo');
        $comida->precio=$request->get('precio');
        $comida->save();
    }
    public function show($id)
    {
        //
        return $comida= Comida::find($id);
    }
    public function update(Request $request, $id)
    {
        //
        $comida=Comida::find($id);
        $comida->tipo=$request->get('tipo');
        $comida->precio=$request->get('precio');
        $comida->update();

    }

    public function destroy($id)
    {
        //
        $comida= Comida::find($id);
        $comida->delete();
    }
}
