<?php 
    require_once('../vendor/autoload.php');
    $pdf = new Dompdf\Dompdf();
    $pdf->set_paper("A4", "portrait");
    ob_start();
    include '123.php';
    $pdf->loadHtml(utf8_decode(ob_get_clean()),'UTF-8');
    $pdf->render();
    $output = $pdf->output();
    $pdf->stream('Ejemplo.pdf');
?>  