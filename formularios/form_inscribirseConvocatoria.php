<?php
    session_start();
    $var=$_SESSION['nombre_postulante'];
    if($var == null || $var = '' ){
        echo "Erro al autentificar";
        header("Location:index.php?error=x");
    }
    $convocatoria = $_GET['id_Con'];
    $postulante = $_GET['id_Pos'];
    require_once('../modelo/postulante.php');
    $Conv_post = new Postulante();
    $respuesta = $Conv_post->insertarConvocatoriaPostulante($convocatoria,$postulante);
    if(strlen($respuesta)>0){
        echo "Se a ralacionado<br>";
        echo $respuesta;
    }else{
        echo "Error al relacionar";
    }
?>