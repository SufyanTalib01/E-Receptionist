<?php
require_once('DB.php'); 
require('fpdf/fpdf.php'); // Include the FPDF file

$id = $_POST['id'];
$getPatientData = $obj->db_patient_doctor_data($id);

class PDF extends FPDF {
    // Footer Function
    function Footer() {
        $this->SetY(-15); // Position 1.5 cm from bottom
        $this->SetFont('Arial', 'I', 5);
        $this->SetTextColor(100, 100, 100);
        $this->Line(0, $this->GetY(), 58, $this->GetY()); // Line within page width
        $this->Cell(0, 4, 'Near Rehmani Masjid Arshad Clinic', 0, 1, 'C');
        $this->Cell(0, 0, 'Kareemabad, Mirpurkhas', 0, 1, 'C');
        $this->Cell(0, 4, '031-33502107', 0, 1, 'C');
    }
}

// Create PDF with small receipt size
$pdf = new PDF('P', 'mm', array(58, 90)); // Start with default height
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$pageWidth = $pdf->GetPageWidth();

// Set the image width
$imageWidth = 15;

// Calculate the X-coordinate to center the image
$x = ($pageWidth - $imageWidth) / 2;

// Add the image at the calculated X-coordinate
// $pdf->Image('C:/laragon/www/EReceptionist/assets/images/logo.png', $x, 0, $imageWidth);
$pdf->Cell(0, 8, 'E-Receptionist Hospital', 0, 1, 'C'); // Centered Title
$pdf->Cell(0, 4, 'Token No: ' . $getPatientData['id'] , 0, 1, 'C'); // Centered Title

$pdf->Ln(2);

// Patient Data
$token_no = $getPatientData['id'];
$patient_name = $getPatientData['name'];
$doctor_name = $getPatientData['doctor_name'];
$doctor_fee = $getPatientData['fee'];
$date = date('Y-m-d');

// **Margins for the table**
$margin = 3; // Left-Right Margin
$column_widths = [22, 30]; // Adjusted widths to fit properlyy



// Table Data
$pdf->SetFont('Arial', '', 8);
$pdf->SetX($margin);
// Table Data without borders
$pdf->Cell($column_widths[0], 6, 'Patient Name:', 0 , );
$pdf->Cell($column_widths[1], 6, $patient_name, 0, 1);
$pdf->SetX($margin);
$pdf->Cell($column_widths[0], 6, 'Doctor', 0);
$pdf->Cell($column_widths[1], 6, $doctor_name, 0, 1);
$pdf->SetX($margin);
$pdf->Cell($column_widths[0], 6, 'Fee', 0);
$pdf->Cell($column_widths[1], 6, $doctor_fee, 0, 1);
$pdf->SetX($margin);
$pdf->Cell($column_widths[0], 6, 'Date', 0);
$pdf->Cell($column_widths[1], 6, $date, 0, 1);

// Space before footer
$pdf->Ln(5);
$pdf->Cell(0, 2, "Please wait for your turn.", 0, 1, 'C');

// Output PDF
$pdf->Output();
?>
