<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class pruebaController extends Controller
{
    public function pdf(){
    	 
    	 
    	 $pdf=new Fpdf('P','mm','A4');    

    	 $pdf->AddPage();

		 $pdf->SetFont('Courier', 'B', 18);

    	 $pdf->Cell(50, 25, 'Hello World!');
    	 
    	 $pdf->Output();
    	 exit;



    }
}
