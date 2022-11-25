<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class graficoController extends Controller
{
    //
        public function getDatos($id){
        //OBTENEMOS LAS ETIQUETAS
        /*$etiquetas = DB::SELECT("SELECT DISTINCT(nombre) 
            FROM ingredientes");
        $labels=[];
        //CONVERTIMOS EL ARRAY JSON A UN ARRAY PLANO
        foreach ($etiquetas as $etiqueta){
             array_push($labels,$etiqueta->nombre);
            
        }*/
       // return $labels;
        //obtenemos los datos de la serie 1
        $serie1=DB::SELECT("SELECT cantidad, nombre 
                            FROM ingredientes
                            WHERE cantidad<=$id");
        $s1=[];
        foreach ($serie1 as $ser1) {
            array_push($s1,
            $ser1->cantidad,
            $ser1->nombre);
        }
        /*return $s1;
         $serie2=DB::SELECT("SELECT cantidad 
                            FROM ingredientes
                            WHERE cantidad>$id");
          $s2=[];

        foreach ($serie2 as $ser2) {
            array_push($s2,$ser2->cantidad);
        }*/


        return $ingredientes=[
            'serie1'=>$s1
        ];
    }//fin de get
}
