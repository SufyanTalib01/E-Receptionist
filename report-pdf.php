<?php 
    require_once 'tcpdf/tcpdf.php';

    // Create a new PDF document
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetMargins(15, 20, 15); // Set margins
    $pdf->SetAutoPageBreak(true, 20);
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);
    
    // Title
    $pdf->Cell(0, 10, 'Patient Information', 0, 1, 'C');
    
    // Define table HTML
    $html  = 
    '<table border="1" cellpadding="6">
        <tr>
            <th><strong>Patient Token</strong></th>
            <th><strong>Patient Name</strong></th>
            <th><strong>Doctor</strong></th>
            <th><strong>Doctor Fee</strong></th>
            <th><strong>Added By</strong></th>
        </tr>
        <tr>
            <td>5</td>
            <td>Mohammad Khan</td>
            <td>Dr Wasay</td>
            <td>1500 PKR</td>
            <td>Sufyan Talib</td>
        </tr>
    </table>';
    
    // Write table to PDF
    $pdf->writeHTML($html, true, false, true, false, '');
    
    // Output PDF
    $pdf->Output(); // 'D' for download
    
    
    
    
?>
