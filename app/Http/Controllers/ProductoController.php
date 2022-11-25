<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        return $productos=Producto::all();
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
        $producto= new Producto();

        $producto->nombre=$request->get('nombre');
        $producto->precio=$request->get('precio');
        $producto->cantidad=$request->get('cantidad');
        $producto->foto=$request->get('foto');
        $producto->id_comida=$request->get('id_comida');

        $producto->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     return $producto=Producto::find($id);
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
        $producto = Producto::find($id);
        $producto->nombre=$request->get('nombre');
        $producto->precio=$request->get('precio');
        $producto->cantidad=$request->get('cantidad');
        $producto->id_comida=$request->get('id_comida');
        $producto->foto=$request->get('foto');

        $producto->update();
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
        $producto=Producto::find($id);

        $producto->delete();
    }

    public function obtenerProductos(){
        return 'HOLA MUNDO';
    }
}
