<?php

require_once 'DB.php';
require 'phpspreadsheet/src/PhpSpreadsheet/Spreadsheet.php';
require 'phpspreadsheet/src/PhpSpreadsheet/Writer/Xlsx.php';
require 'phpspreadsheet/src/PhpSpreadsheet/IOFactory.php';

$formData = $_SESSION['form_data'];
$reportAllData = $obj->db_report_pdf($formData);

$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : '';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



// Create new Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set Title
$sheet->setCellValue('A1', 'E-Receptionist Hospital');
$sheet->mergeCells('A1:E1'); // Merge columns for title
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

$sheet->setCellValue('A2', 'Patients Information');
$sheet->mergeCells('A2:E2');
$sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

// Set Date Range
$sheet->setCellValue('A3', "Start Date: $startDate | End Date: $endDate");
$sheet->mergeCells('A3:E3');
$sheet->getStyle('A3')->getFont()->setBold(true);
$sheet->getStyle('A3')->getAlignment()->setHorizontal('center');

// Column Headers
$sheet->setCellValue('A5', 'Patient Token');
$sheet->setCellValue('B5', 'Patient Name');
$sheet->setCellValue('C5', 'Doctor');
$sheet->setCellValue('D5', 'Fee (PKR)');
$sheet->setCellValue('E5', 'Added By');

// Make headers bold
$sheet->getStyle('A5:E5')->getFont()->setBold(true);

// Add Data Rows
$row = 6;
if (!empty($reportAllData)) {
    foreach ($reportAllData as $reportData) {
        $sheet->setCellValue('A' . $row, $reportData['patient_id']);
        $sheet->setCellValue('B' . $row, $reportData['patient_name']);
        $sheet->setCellValue('C' . $row, $reportData['doctor_name']);
        $sheet->setCellValue('D' . $row, $reportData['fee']);
        $sheet->setCellValue('E' . $row, $reportData['created_by']);
        $row++;
    }
}

// Auto-size columns for better readabilityy
foreach (range('A', 'E') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Set Headers for Downloading Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="patients_report.xlsx"');
header('Cache-Control: max-age=0');

// Create Excel File and Output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
