<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Mascota;

class ReporteController extends Controller
{
    public function pdf(){

    	// OBTENEMOS EL LISTADO DE MASCOTAS

    	$mascotas = Mascota::all();
    	// return $mascotas;


    	// Instanciando un objeto
    	$pdf=new Fpdf('P','mm','A4');

    	// Agregando una página
    	$pdf->AddPage();

    	// Establecer una fuente
    	$pdf->SetFont('Arial', '', 18);


    	// Cuerpo del reporte
    	
    	$pdf->Image(public_path().'/images/logo.png', 10, 4,28);
    	$pdf->Ln(3);
    	$pdf->Cell(188,6,'LISTADO DE MASCOTAS','B',1,'C');
    	$pdf->Ln(10);
    	
    	
    	$pdf->SetFont('Courier', '', 12);
    	

    	// ENCABEZADO DEL REPORTE
    	// Celda de margen
    	$pdf->Cell(25,5,'',0,0);
    	
    	$pdf->Cell(10,5,'No',1,0,'C');
    	$pdf->Cell(50,5,'Nombre',1,0,'C');
    	$pdf->Cell(15,5,'Edad',1,0,'C');
    	$pdf->Cell(20,5,'Peso',1,0,'C');
    	$pdf->Cell(20,5,'Genero',1,0,'C');
    	$pdf->Cell(20,5,'Especie',1,1);





    	// TABLA DE DATOS

    	// Celda de margen

    	$alt=10;
    	// for ($i=1; $i <10 ; $i++) { 
	    	
	    // 	$pdf->Cell(35,$alt,'',0,0);
	    // 	$pdf->Cell(10,$alt,"$i",1,0,'C');
	    // 	$pdf->Cell(50,$alt,"Mascota$i",1,0,'L');
	    // 	$pdf->Cell(15,$alt,'8',1,0,'C');
	    // 	$pdf->Cell(20,$alt,'23',1,0,'C');
	    // 	$pdf->Cell(20,$alt,'H',1,1,'C');

    	// }

    	foreach ($mascotas as $mascota) {
    		$pdf->Cell(25,$alt,'',0,0);
    		// Imprimo el id_mascota
	    	$pdf->Cell(10,$alt,$mascota->id_mascota,1,0,'C');
	    	// Imprimo el nombre de la mascota
	    	$pdf->Cell(50,$alt,utf8_decode($mascota->nombre),1,0,'L');
	    	$pdf->Cell(15,$alt,$mascota->edad,1,0,'C');
	    	$pdf->Cell(20,$alt,$mascota->peso,1,0,'C');
	    	$pdf->Cell(20,$alt,$mascota->genero,1,0,'C');
	    	$pdf->Cell(20,$alt,utf8_decode($mascota->especie->especie),1,1,'L');
    	}

    	








    	// Cierre del reporte
    	$pdf->Output('I','Listado de mascotas.pdf');
    	exit;


    }
}
