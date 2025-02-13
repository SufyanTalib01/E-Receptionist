<?php
require_once('DB.php'); 
require('fpdf/fpdf.php'); // Include the FPDF file

$id = $_POST['id'];
$getPatientData = $obj->db_patient_doctor_data($id);


// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage(); // Add a new page
$pdf->SetFont('Arial', 'B', 16); // Set font

$pdf->Image('C:/laragon/www/EReceptionist/assets/images/logo.png', 10, 10, 30);

$pdf->SetY(40);

// Add a title
$pdf->Cell(190, 10, 'Reciept', 1, 1, 'C');

// Set font for patient details
$pdf->SetFont('Arial', '', 12);

// Patient ID
$pdf->Cell(50, 10, 'Patient ID:', 1);
$pdf->Cell(140, 10, $getPatientData['id'] , 1, 1);
// Name
$pdf->Cell(50, 10, 'Patient Name:', 1);
$pdf->Cell(140, 10, $getPatientData['name'] , 1, 1);
// Father Name
$pdf->Cell(50, 10, 'Father Name:', 1);
$pdf->Cell(140, 10, $getPatientData['father_name'] , 1, 1);

$pdf->Cell(50, 10, 'Age:', 1);
$pdf->Cell(140, 10, '30', 1, 1);

// Doctor
$pdf->Cell(50, 10, 'Doctor:', 1);
$pdf->Cell(140, 10, $getPatientData['doctor_name'] , 1, 1);

// Doctor FEE
$pdf->Cell(50, 10, 'Fee:', 1);
$pdf->Cell(140, 10, $getPatientData['fee'] , 1, 1);

// Doctor FEE
$pdf->Cell(50, 10, 'Receptionist:', 1);
$pdf->Cell(140, 10, $getPatientData['created_by'] , 1, 1);

// Output the PDF file for download
$pdf->Output('patient_report.pdf', 'D'); // 'D' means download
?>
