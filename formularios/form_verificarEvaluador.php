<?php
    if(isset($_POST['idCorreo']) && isset($_POST['idPass'])){
        $idCorreo = $_POST['idCorreo'];
        $idPas = $_POST['idPass'];
        require_once('../modelo/evaluadoresMeritos.php');
        $evaluador = new Evaluador();
        $res = $evaluador->verificarEvaluador($idCorreo,$idPas);
        if($res){
            $respuesta = $res[0];
            session_start();
            $_SESSION['nombreEvaluador'] = $respuesta['nombre_evaluador'];
            $_SESSION['idEvaluador'] = $respuesta['id_evaluador'];
            header("Location:../paginas/indexEvaluador.php");
        }else{
            echo "No existe ese evaluador";
        }
    }else{
        echo "No se puede procesar la informacion";
    }
?>