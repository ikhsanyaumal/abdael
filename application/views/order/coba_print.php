<?php
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','',12);
  $teks = 'Cara Gampang Integrasi FPDF dengan Codeigniter '.$nama;
  // mencetak 10 baris kalimat dalam variable "teks".
  for( $i=0; $i < 10; $i++ ) {
      $pdf->Cell(0, 5, $teks, 1, 1, 'L'); 
  }
  $pdf->Output();
?>