<?php 
    session_start();
    $var=$_SESSION['nombre_postulante'];
    if($var == null || $var = '' ){
        echo "Erro al autentificar";
        header("Location:../index.php?error=x");
    }
    if(isset($_GET['id_post']) && isset($_GET['id_mat'])){
        $_SESSION['id_post'] = $_GET['id_post'];
        $_SESSION['id_mat'] = $_GET['id_mat'];
        require_once('../vendor/autoload.php');
        $pdf = new Dompdf\Dompdf();
        $pdf->set_paper("A4", "portrait");
        ob_start();
        include "generarRotulo.php";
        $pdf->loadHtml(utf8_decode(ob_get_clean()),'UTF-8');
        //header("Location:generarRotulo.php");
        $pdf->render();
        $output = $pdf->output();
        $pdf->stream('My_rotulo.pdf',array('Attachment'=>0));
    }else{
        echo "No se puede procesar el formulario";
    }
?>
