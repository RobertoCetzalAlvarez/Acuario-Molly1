<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Egreso;
use DB;
class EgresoController extends Controller
{
    public function index()
    {
        //
        return $egreso = DB::SELECT("SELECT * FROM egresos
        ORDER BY id DESC");
    }
    public function store(Request $request)
    {
        //
        $egreso=new Egreso();
        $egreso->fecha=$request->get('fecha');
        $egreso->producto=$request->get('producto');
        $egreso->costo=$request->get('costo');
        $egreso->cantidad=$request->get('cantidad');
        
        $egreso->save();
    }
    public function show($id)
    {
        //
        return $egreso= Egreso::find($id);
    }
    public function update(Request $request, $id)
    {
        //
        $egreso=Egreso::find($id);
        $egreso->fecha=$request->get('fecha');
        $egreso->producto=$request->get('producto');
        $egreso->costo=$request->get('costo');
        $egreso->cantidad=$request->get('cantidad');
        
        $egreso->update();

    }

    public function destroy($id)
    {
        //
        $egreso= Egreso::find($id);
        $egreso->delete();
    }
}
