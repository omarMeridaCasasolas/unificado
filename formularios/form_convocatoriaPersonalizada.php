<?php
    $titulo=$_POST['titulo'];
    $gestion=$_POST['gestion'];
    $descripcion=$_POST['descripcion'];
    $requerimiento=$_POST['requerimiento'];
    $requisito=$_POST['requisito'];
    $documentosAPresentar=$_POST['documentosAPresentar'];
    include_once("../vendor/autoload.php");
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    $myHtml = "<!DOCTYPE html>
            <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content=?width=device-width, initial-scale=1.'>
                    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'>
                    <title>UMSS</title>
                </head>
                <body>
                    <h4 class='text-center'>".$titulo."</h4>
                    <h4 class='text-center'>==========================</h4>
                    <h4 class='text-center'>".$gestion."</h4>
                    <p>".$descripcion."</p>
                    <p>".$requerimiento."</p>
                    <p>".$requisito."</p>
                    <p>".$documentosAPresentar."</p>
                </body>
            </html> ";

    $dompdf->loadHtml($myHtml);
    $dompdf->render();
    $contenido = $dompdf->output();
    $nombreDelDocumento = "MiPdf.pdf";
    $bytes = file_put_contents($nombreDelDocumento, $contenido);

?>
