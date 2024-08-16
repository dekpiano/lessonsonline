<?php session_start();
require('../../../../plugins/fpdf/fpdf.php');
 
$pdf=new FPDF( 'L' , 'mm' ,'A4');
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
$pdf->AddPage();
$pdf->Image("../../../../dist/img/certificate/cf1.png",0,0,300,0,'','');
$pdf->SetXY(10,90);
$pdf->SetFont('THSarabunNew','b',36);
$pdf->Cell( 0  , 10 , iconv('UTF-8', 'cp874', $_SESSION['FullName']), 0 , 1 , 'C' );
$pdf->AddPage();
$pdf->Image("../../../../dist/img/certificate/cg1.png",0,0,300,0,'','');

$pdf->Output();
?>