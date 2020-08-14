<?php
    $correo = $_POST['correoPostulante'];
    $password = $_POST['passPostulante'];
    require_once('../modelo/postulante.php');
    $postulante = new Postulante();
    $respuesta = $postulante->verificarPostulante($correo,$password);
    var_dump($respuesta);
    if($respuesta){
        session_start();
        $_SESSION['nombre_postulante'] = $respuesta['nombre_postulante'];
        $_SESSION['id_postulante'] = $respuesta['id_postulante'];
        header("Location:../paginas/index_postulante.php");
    }else{
        header("Location:../paginas/postulante.php?problem=x");
    }
        
