<?php
require_once('DB.php'); 
require('fpdf/fpdf.php'); // Include the FPDF file

$id = $_POST['id'];
$getPatientData = $obj->db_patient_doctor_data($id);

class PDF extends FPDF {
    // Footer Function
    function Footer() {
        $this->SetY(-15); // Position 1.5 cm from bottom
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(100, 100, 100);

        // Add horizontal line
        $this->Line(10, $this->GetY(), 200, $this->GetY());

        // Add footer text (date + page number)
        $this->Cell(0, 10, 'Generated on: ' . date('d-m-Y') . ' | Page ' , 0, 0, 'C');
        
    }
}

// Create a new PDF instance
$pdf = new PDF();
$pdf->AddPage(); // Add a new page
$pdf->SetFont('Arial', 'B', 16); // Set font

// Logo
$pdf->Image('C:/laragon/www/EReceptionist/assets/images/logo.png', 0, 0, 30);
$pdf->Cell(0, 10, 'E-Receptionist Hospital', 0, 1, 'C'); 



$pdf->SetXY(50, 10);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 8, 'Helpline: +92 313 3502107', 0, 0, 'R'); // Right aligned

$pdf->SetXY(50, 14);
$pdf->Cell(0, 8, 'Email: sufyantalib125@gmail.com', 0, 0, 'R'); // Right aligned


$pdf->SetY(30);

$pdf->SetFont('Arial', 'B', 16); // Set font
// Add a title
$pdf->Cell(190, 10, 'Receipt', 1, 1, 'C');

// Set font for patient details
$pdf->SetFont('Arial', '', 12);

// Patient ID
$pdf->Cell(50, 10, 'Patient ID:', 1);
$pdf->Cell(140, 10, $getPatientData['id'], 1, 1);
// Name
$pdf->Cell(50, 10, 'Patient Name:', 1);
$pdf->Cell(140, 10, $getPatientData['name'], 1, 1);
// Father Name
$pdf->Cell(50, 10, 'Father Name:', 1);
$pdf->Cell(140, 10, $getPatientData['father_name'], 1, 1);

$pdf->Cell(50, 10, 'Age:', 1);
$pdf->Cell(140, 10, '30', 1, 1);

// Doctor
$pdf->Cell(50, 10, 'Doctor:', 1);
$pdf->Cell(140, 10, $getPatientData['doctor_name'], 1, 1);

// Doctor Fee
$pdf->Cell(50, 10, 'Fee:', 1);
$pdf->Cell(140, 10, $getPatientData['fee'], 1, 1);

// Receptionist
$pdf->Cell(50, 10, 'Receptionist:', 1);
$pdf->Cell(140, 10, $getPatientData['created_by'], 1, 1);

// Output the PDF file for download
$pdf->Output('patient_report.pdf', 'D'); // 'D' means download
?>
