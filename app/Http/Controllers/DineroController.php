<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dinero_Venta;

class DineroController extends Controller
{
    public function index()
    {
        //
        return $dinero=Dinero_Venta::all();
    }
    public function store(Request $request)
    {
        //
        $dinero=new Dinero_Venta();
        $dinero->fecha=$request->get('fecha');
        $dinero->total=$request->get('total');
        $dinero->save();
    }
    public function show($id)
    {
        //
        return $dinero= Dinero_Venta::find($id);
    }
    public function update(Request $request, $id)
    {
        //
        $dinero=Dinero_Venta::find($id);
        $dinero->fecha=$request->get('fecha');
        $dinero->total=$request->get('total');
        $dinero->update();

    }

    public function destroy($id)
    {
        //
        $dinero= Dinero_Venta::find($id);
        $dinero->delete();
    }
}
