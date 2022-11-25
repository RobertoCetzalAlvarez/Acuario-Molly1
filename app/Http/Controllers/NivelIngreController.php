<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NivelIngreController extends Controller
{
    //
    public function getDatos($id){

      return  $getDatos=DB::SELECT("SELECT cantidad, nombre, sku 
                                    FROM ingredientes
                                    WHERE cantidad<=$id");
       
    }//fin de get
    public function getInventario($id){

      return  $getDatos=DB::SELECT("SELECT cantidad, nombre, sku, precio 
                                    FROM productos
                                    WHERE cantidad<=$id"
                            );
       
    }//fin de inventario
    public function getVentaDinero($id, $id2){
      return $getDatos=DB::SELECT("SELECT folio, fecha_venta, total, Propina, pago
                                   FROM ventas
                                   WHERE fecha_venta >='$id' AND fecha_venta <='$id2'");
    }
    public function getProducto($id){
      return $getDatos=DB::SELECT("SELECT sku, cantidad, folio, nombre
                                   FROM detalle_entradas
                                   WHERE folio = '$id'");
    }
    public function getVentaHistoria($id){
      return $getDatos=DB::SELECT("SELECT cantidad, folio, precio, total, nombre
                                   FROM detalle_ventas
                                   WHERE folio = '$id'");
    }
    public function getHentra($id){
      return $getDatos=DB::SELECT("SELECT *
                                   FROM ingrediente_detalle_entradas
                                   WHERE folio = '$id'");
    }
    public function getsalida($id){
      return $getDatos=DB::SELECT("SELECT *
                                   FROM ingrediente_detalle_salidas
                                   WHERE folio = '$id'");
    }
    public function getEgresos($id, $id2){
      return $getDatos=DB::SELECT("SELECT *
                                   FROM egresos
                                   WHERE fecha >='$id' AND fecha <='$id2'");
    }
    public function getInicio($id, $id2){
      return $getDatos=DB::SELECT("SELECT *
                                   FROM inicios
                                   WHERE fecha >='$id' AND fecha <='$id2'");
    }
}
