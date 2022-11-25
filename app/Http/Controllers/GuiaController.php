<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Guia;

class GuiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $guia = Guia::all();
    }
    public function store(Request $request)
    {
        //
        $guia = new Guia();
        $guia->nombre=$request->get('nombre');
        $guia->celular=$request->get('celular');
        $guia->save();

    }
    public function show($id)
    {
        //
        return $guia = Guia::find($id);

    }
    public function update(Request $request, $id)
    {
        //
        $guia = Guia::find($id);

        $guia->nombre=$request->get('nombre');
        $guia->celular=$request->get('celular');
        $guia->update();
    }
    public function destroy($id)
    {
        //
        $guia = Guia::find($id);
        $guia->delete();
    }
}
