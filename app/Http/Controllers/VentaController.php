<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use Codedge\Fpdf\Fpdf\Fpdf;
Use App\Producto;
use App\DetalleVenta;
use DB;


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $productos=Producto::all();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        //Seccion del manejo de la venta
        //return $r;

         $venta = new Venta;

        $venta->folio=$r->get('folio');
        $venta->fecha_venta=$r->get('fecha_venta');
        $venta->num_articulos=$r->get('num_articulos');
        $venta->subtotal=$r->get('subtotal');
        $venta->iva=$r->get('iva');
        $venta->total=$r->get('total');
        $venta->guia=$r->get('guia');
        $venta->Propina=$r->get('Propina');
        $venta->comicion=$r->get('comicion');
        $venta->pago=$r->get('pago');

        $venta->save();

        //Fin de manejo de la ventas

        //Obtenemos del Request el json de los detalles
        $detalles = $r->get('detalles');

        //Insertamos los detalles a la tabla detalle_vemtas
        DetalleVenta::insert($detalles);
        //Dinero_Venta::insert($detalles2);
        //Actualizamos el estado de los inventarios
        for ($i=0; $i < count($detalles); $i++) { 

            $cantidadVendida=$detalles[$i]['cantidad'];
            $productoVendido=$detalles[$i]['sku'];

            DB::update("UPDATE productos
                SET cantidad=cantidad-$cantidadVendida
                WHERE sku=$productoVendido");

           
        }
        
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
        return $venta=Venta::find($id);
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
    }
    //AQUI EMPIEZA EL TICKET DE VENTA
    public function ticket($folio){
         $venta= Venta::find($folio);
        $altura = 100;

       //Definimos el tamaño del ticket
       $pdf = new Fpdf('P', 'mm', array(58,$altura ));

       $pdf->AddPage();

      $pdf->SetMargins(3,2,3);
       $pdf->SetFont('Arial', 'B', 6);
       $pdf->Cell(31,3,'HOTEL Y RESTAURANTE ',0,1,'C');
       $pdf->Cell(15,3,'',0,0,'C');
       $pdf->Cell(15,3,'SANTA MARIA',0,1,'C');
       $pdf->Cell(8,3, 'FOLIO:', 0,0,'L');
       $pdf->Cell(20,3, $venta->folio,0,1,'L');
       $pdf->Cell(10,3, 'FECHA:',0,0,'L');
       $pdf->Cell(10,3, $venta->fecha_venta, 0,1,'L');
       $pdf->Cell(40,1,'','B','C');
       $pdf->Ln(2);
       $ancho=13;
       $pdf->SetFont('Arial', 'B', 5);
       $pdf->Cell(5,3, 'SKU',1,0,'C');
       $pdf->Cell($ancho,3, 'PRODUTO',1,0,'C');
       $pdf->Cell(8,3, 'CANT',1,0,'C');
       $pdf->Cell(5,3, 'P.U',1,0,'C');
       $pdf->Cell(8,3,'TOTAL',1,1,'C');

       $detalles=$venta->detalles;
        $ancho=15;
       foreach ($detalles as $detalle) {
            $pdf->Cell(5,3,$detalle->sku,0,0,'C');
            $pdf->Cell($ancho,3,$detalle->nombre,0,0,'C');
            $pdf->Cell(8,3,$detalle->cantidad,0,0,'C');
            $pdf->Cell(5,3,$detalle->precio,0,0,'C');
            $pdf->Cell(8,3,$detalle->total,0,1,'C');
       }
       $ancho=20;
       $pdf->Cell($ancho,3,'',0,0,'C');
       $pdf->Cell(10,3, 'SUBTOTAL',1,0,'C');
       $pdf->Cell(10,3,$venta->subtotal,1,1,'C');
       /*$pdf->Cell($ancho,3,'',0,0,'C');
       $pdf->Cell(10,3,'IVA',1,0,'C');
       $pdf->Cell(10,3,$venta->iva,1,1,'C');*/
       $pdf->Cell($ancho,3,'',0,0,'C');
       $pdf->Cell(10,3,'PROPINA',1,0,'C');
       $pdf->Cell(10,3,$venta->Propina,1,1,'C');
       $pdf->Cell($ancho,3,'',0,0,'C');
       $pdf->Cell(10,3, 'TOTAL',1,0,'C');
       $pdf->Cell(10,3,$venta->total,1,1,'C');
       $pdf->Ln(2);
    
       $pdf->OutPut('','folio'.$folio.'pdf');
       exit;
    }
    //AQUI TERMINA EL TICKET DE VENTA
public function getDatos($id){

        $getDatos=DB::SELECT("SELECT cantidad, nombre, sku 
                              FROM ingredientes
                              WHERE cantidad<=$id");

$altura = 100;

//Definimos el tamaño del ticket
$pdf = new Fpdf('P', 'mm', array(58,$altura ));

$pdf->AddPage();

$pdf->SetMargins(3,2,3);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(31,3,'HOTEL Y RESTAURANTE ',0,1,'C');
$pdf->Cell(15,3,'',0,0,'C');
$pdf->Cell(15,3,'SANTA MARIA',0,1,'C');
$pdf->Cell(15,3,'',0,0,'C');
$pdf->Cell(15,3,'PRODUCTOS POR AGOTARSE',0,1,'C');
$pdf->Cell(40,1,'','B','C');
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(5,3, 'SKU',1,0,'C');
$pdf->Cell(25,3, 'NOMBRE',1,0,'C');
$pdf->Cell(10,3, 'CANTIDAD',1,1,'C');

//$detalles=$getDatos->detalles;

foreach ($getDatos as $getDatos) {
    $pdf->Cell(5,3,$getDatos->sku,0,0,'C');
    $pdf->Cell(25,3,$getDatos->nombre,0,0,'C');
    $pdf->Cell(8,3,$getDatos->cantidad,0,1,'C');
}
$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(48,2,'CEL: 9991630189',0,1,'L');
/*$pdf->Cell(48,2,'PUNTO DE VENTAS ',0,1,'L');
$pdf->Cell(48,2,'PROGRAMADO POR ROBERTO ANGEL',0,1,'L');*/


$pdf->OutPut();
exit;
}//fin de get

public function getDatos2($id){

    $getDatos=DB::SELECT("SELECT cantidad, nombre, sku, precio 
                            FROM productos
                            WHERE cantidad<=$id"
                        );

$altura = 100;

//Definimos el tamaño del ticket
$pdf = new Fpdf('P', 'mm', array(58,$altura ));

$pdf->AddPage();

$pdf->SetMargins(3,2,3);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(31,3,'HOTEL Y RESTAURANTE ',0,1,'C');
$pdf->Cell(15,3,'',0,0,'C');
$pdf->Cell(15,3,'SANTA MARIA',0,1,'C');
$pdf->Cell(15,3,'',0,0,'C');
$pdf->Cell(15,3,'PRODUCTOS POR AGOTARSE',0,1,'C');
$pdf->Cell(40,1,'','B','C');
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(5,3, 'SKU',1,0,'C');
$pdf->Cell(25,3, 'NOMBRE',1,0,'C');
$pdf->Cell(10,3, 'CANTIDAD',1,1,'C');

//$detalles=$getDatos->detalles;

foreach ($getDatos as $getDatos) {
$pdf->Cell(5,3,$getDatos->sku,0,0,'C');
$pdf->Cell(25,3,$getDatos->nombre,0,0,'C');
$pdf->Cell(8,3,$getDatos->cantidad,0,1,'C');
}
$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(48,2,'CEL: 9991630189',0,1,'L');
/*$pdf->Cell(48,2,'PUNTO DE VENTAS ',0,1,'L');
$pdf->Cell(48,2,'PROGRAMADO POR ROBERTO ANGEL',0,1,'L');*/


$pdf->OutPut();
exit;
}//fin de get2
      
}
