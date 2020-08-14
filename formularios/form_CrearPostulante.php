<?php
    $password = $_POST['passPostulante'];
    $repeatPassword = $_POST['passRepeat'];
    if($password == $repeatPassword){
        $nombrePostulante = $_POST['nombrePostulante'];
        $ciPostulante = $_POST['ciPostulante'];
        $correoPostulante = $_POST['correoPostulante'];
        $telefonoPostulante = $_POST['telefonoPostulante'];
        include_once('../modelo/postulante.php');
        $postulante = new Postulante();
        $respuesta = $postulante->insertarPostulante($nombrePostulante,$ciPostulante,$correoPostulante,$telefonoPostulante,$password);
        $_SESSION['ciPostulante'] = $ciPostulante;
        header("Location:../paginas/index_postulante.php");
    }else{
        header("Location:../paginas/crearNuevaCuenta.php?error=x");
    }

?>