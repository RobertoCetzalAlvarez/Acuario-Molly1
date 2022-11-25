<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $tipos=Tipo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $tipo=new Tipo();
        $tipo->tipo=$request->get('tipo');
        $tipo->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $tipo=Tipo::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $tipo=Tipo::find($id);
        $tipo->tipo=$request->get('tipo');
        $tipo->update();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tipo=Tipo::find($id);
        $tipo->delete();
    }

    public function getTipos($id_tipo){
        /*se selecciona todo en la tabla tipos en donde la id del tipo sea igual a la variable recibida $id_tipo*/
        $tipos=DB::select("SELECT * FROM tipos WHERE id_tipo=$id_tipo");

        return $tipos;
    }
}
