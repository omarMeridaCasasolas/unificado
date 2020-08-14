<?php
    session_start();
    $var=$_SESSION['sesion'];
    if($var == null || $var = '' ){
        echo "Error al autentificar";
        header("Location:../index.php?error=x");
    }
    require_once("../modelo/administrativo.php");
    $administrativo= new Administrativo();
    $nuevoCorreo=$_POST['nuevoCorreo'];
    $nuevoTelefono=$_POST['numeroTelefonico'];
    $nuevoPass=$_POST['nuevoPassword'];
    $CpyNuevoPass=$_POST['copiaNuevoPassword'];
    $aux=true;
    $bandera=true;
    if($nuevoPass!=$CpyNuevoPass){
        $bandera=false;
        header("Location:../paginas/cambiarEmailPassword.php?problem=x");        
    }else{
        if($nuevoPass!=$_SESSION['passoword']){
            $res=$administrativo->actualizarPasswordAdministrativo($nuevoPass,$_SESSION['correo']);
            $hash = password_hash($nuevoPass, PASSWORD_DEFAULT, ['cost' => 10]);
            echo $hash;
            $aux=$administrativo->actualizarPasswordCodificadoAdministrativo($hash,$_SESSION['correo']);
        }
    }
    if($nuevoTelefono!=$_SESSION['telefono']){
        $administrativo->actualizarTelefonoAdministrativo($nuevoTelefono,$_SESSION['correo']);
    }
    if($nuevoCorreo!=$_SESSION['correo']){
        $administrativo->actualizarCorreoAdministrativo($nuevoCorreo,$_SESSION['correo']);
    }

    $administrativo->cerrarConexion();

    if($bandera){
        header("Location:../paginas/CRUD_publicaciones.php");
    }
        
    
?>