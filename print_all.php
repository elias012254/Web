<?php
require('fpdf/fpdf.php');
include('config.php');

$pdf = new FPDF();
///var_dump(get_class_methods($pdf));

$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,10,'Date:'.date('d-m-Y').'',0,"R");
$pdf->Ln(15);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Usuarios',1,1,"C");
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,8,'No.',1);
$pdf->Cell(45,8,'Nombre',1);
$pdf->Cell(45,8,'Ap. Paterno',1);
$pdf->Cell(45,8,'Ap. Materno',1);
$pdf->Cell(45,8,'Correo Electrónico',1);

$query="SELECT * FROM usuarios";
$result = mysqli_query($mysqli, $query);
$no=0;
while($row = mysqli_fetch_array($result)){
    $no=$no+1;
    $pdf->Ln(8);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10,8,$no,1);
    $pdf->Cell(45,8,$row['nombre'],1);
    $pdf->Cell(45,8,$row['paterno'],1);
    $pdf->Cell(45,8,$row['materno'],1);
    $pdf->Cell(45,8,$row['correo'],1);
}
$pdf->Output();
?>