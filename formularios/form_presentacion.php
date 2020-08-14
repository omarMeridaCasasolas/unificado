<?php
    session_start();
    $formaPresentacion = $_POST['idFormaPresentacion'];
    $fechaPresentacion = $_POST['idFechaPresentacion'];
    require_once('../modelo/convocatoriaUnica.php');
    $convocatoria = new ConvocatoriaUnica();
    $respuesta = $convocatoria->actualizarPresentacion($_SESSION['claveConvocatoria'],$formaPresentacion,$fechaPresentacion);
    header("Location:../paginas/presentacionDocencia.php");
?>