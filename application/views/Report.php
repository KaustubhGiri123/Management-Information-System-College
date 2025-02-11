
<?php
define('DOC_ID', $id);
define('DOC_TITLE', $doc_title);
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('GPM');
$pdf->SetTitle('ADMISION SLIP');
$pdf->SetSubject('IF');
$pdf->SetKeywords('IF,MIS');

// set default header data 
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$body = '<body>';
    foreach($s as $record){
        $body.='<h1 style="font-weight:normal;text-decoration:underline;">ADMISSION SLIP</h1>
             <div style="border:1px solid black;">
             <table style="padding:10px 0 0 20px;">
              <tr>
              <th style="font-weight:bold">Name :</th><td>'.$record->student_fname.' '.$record->student_lname.'</td>
              </tr>
              <tr>
              <th style="font-weight:bold">Father\'s name :</th><td>'.$record->father_name.' '.$record->student_lname.'</td>
              </tr>
              <tr>
              <th style="font-weight:bold">Mother\'s name :</th><td>'.$record->student_mothers_fname.' '.$record->student_mothers_lname.'</td>
              </tr>
              <tr>
              <th style="font-weight:bold">Enrollment number :</th><td>'.$record->student_enrollmentno.'</td>
              </tr>
              <tr>
              <th style="font-weight:bold">Category :</th><td>'.$record->student_caste.'</td>
              </tr>
              <tr>
              <th style="font-weight:bold">Student type :</th><td>'.$record->student_type.'</td>
              </tr>
              <tr>
              <th style="font-weight:bold">Gender :</th><td>'.$record->student_gender.'</td>
              </tr>
              <tr>
              <th style="font-weight:bold">Date of Birth :</th><td>'.$record->student_bdate.'</td>
              </tr>
              <tr>
              <th style="font-weight:bold">Payment Type :</th><td>'.$record->student_payment_type.'</td>
              </tr>
              <tr>
              <th style="font-weight:bold">Admision Date :</th><td>'.$record->student_dateofadmission.'</td>
              </tr>';    
    }
    $body.='<tr>
    <th style="font-weight:bold">Admision Batch :</th><td>'.$year.'</td>
              </tr>';
    foreach($d as $k => $row){
        $body.='<tr>
              <th style="font-weight:bold">Branch Name : </th><td> DIPLOMA IN '.strtoupper($row->dept_name).'</td>
              </tr> </table>
              </div>';
    }
    $body.='<br><br><br><br><br><br><b>(Student sign)</b>  <b><center>(Cashier sign)<center><b> <b>(Admisiion incharge sign)</b></p>';
$body.= '</body>';

$pdf->writeHTML($body, true, false, true, false, '');
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_clean();
$pdf->Output('Admision Slip.pdf', 'I');
// END OF FILE