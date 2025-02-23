<?php

require_once 'tcpdf/tcpdf.php';
require_once 'DB.php';

$formData = $_SESSION['form_data'];
$reportAllData = $obj->db_report_pdf($formData);
$startDate = isset($formData['start_date']) ? $formData['start_date'] : '';
$endDate = isset($formData['end_date']) ? $formData['end_date'] : '';

// $obj->debug($reportAllData);

// Create a new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetMargins(15, 20, 15); // Set margins
$pdf->SetAutoPageBreak(true, 20);
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 18);


$pdf->Cell(0, 10, 'E-Receieptionist Hospital', 0, 1, 'C');

$pdf->SetFont('helvetica', 'B', 14);
// Title
$pdf->Cell(0, 10, 'Patients Information', 0, 1, 'C');


$pdf->SetFont('helvetica', 'B', 12);
// Display Start Date and End Date
$pdf->Cell(0, 10, 'Start Date: ' . $startDate . ' | End Date: ' . $endDate, 0, 1, 'C');
$pdf->Ln(3);

$pdf->SetFont('helvetica', '', 12);

// Start table HTML
$html = '<table border="1" cellpadding="6">
    <tr>
        <th><strong>Patient Token</strong></th>
        <th><strong>Patient Name</strong></th>
        <th><strong>Doctor</strong></th>
        <th><strong>Fee</strong></th>
        <th><strong>Added By</strong></th>
    </tr>';

// Loop through data and add rows dynamically
if (!empty($reportAllData)) {
    foreach ($reportAllData as $reportData) {
        $html .= '<tr>
            <td>' . htmlspecialchars($reportData['patient_id']) . '</td>
            <td>' . htmlspecialchars($reportData['patient_name']) . '</td>
            <td>' . htmlspecialchars($reportData['doctor_name']) . '</td>
            <td>' . htmlspecialchars($reportData['fee']) . ' PKR</td>
            <td>' . htmlspecialchars($reportData['created_by']) . '</td>
        </tr>';
    }
}

// Close table HTML
$html .= '</table>';

// Write table to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF
$pdf->Output();
