<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inicio;
use DB;
class InicioController extends Controller
{
    public function index()
    {
        //
        return $inicio = DB::SELECT("SELECT * FROM inicios
        ORDER BY id DESC");
    }
    public function store(Request $request)
    {
        //
        $inicio=new Inicio();
        $inicio->fecha=$request->get('fecha');
        $inicio->cantidad=$request->get('cantidad');
        
        $inicio->save();
    }
    public function show($id)
    {
        //
        return $inicio= Inicio::find($id);
    }
    public function update(Request $request, $id)
    {
        //
        $inicio=Inicio::find($id);
        $inicio->fecha=$request->get('fecha');
        $inicio->cantidad=$request->get('cantidad');
        
        $inicio->update();

    }

    public function destroy($id)
    {
        //
        $inicio= Inicio::find($id);
        $inicio->delete();
    }
}
