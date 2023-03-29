<?php
// Load autoloader (using Composer)
require '../vendor/autoload.php';
$pdf = new TCPDF();                 // create TCPDF object with default constructor args
$pdf->AddPage();                    // pretty self-explanatory
$pdf->Write(0, urldecode($_GET['name']), '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(40);
$pdf->Write(2,  urldecode($_GET['content']));      // 1 is line height
$pdf->Output('hello_world.pdf');    // send the file inline to the browser (default).
?>