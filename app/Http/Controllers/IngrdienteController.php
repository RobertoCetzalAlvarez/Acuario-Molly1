<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Ingrediente;


class IngrdienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $ingredientes=Ingrediente::all();
    }
    public function store(Request $request)
    {
        //

        $ingrediente= new Ingrediente();

        $ingrediente->nombre=$request->get('nombre');
        $ingrediente->cantidad=$request->get('cantidad');
       // $ingrediente->tipo=$request->get('tipo');
        $ingrediente->id_tipo=$request->get('id_tipo');


        $ingrediente->save();

    }
    public function show($id)
    {
        //
        return $ingrediente=Ingrediente::find($id);
    }
    public function update(Request $request, $id)
    {
        //
        $ingrediente = Ingrediente::find($id);
        $ingrediente->nombre=$request->get('nombre');
        $ingrediente->cantidad=$request->get('cantidad');
        //$ingrediente->id_tipo=$request->get('tipo');
        $ingrediente->id_tipo=$request->get('id_tipo');

        $ingrediente->update();

    }
    public function destroy($id)
    {
        //
        $ingrediente=Ingrediente::find($id);
        $ingrediente->delete();
    }
}
