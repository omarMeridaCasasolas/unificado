<?php 
    session_start();
    $idMateria = $_POST['id_materia'];
    $idPostulante = $_POST['id_postulante'];
    $idConvocatoria = $_POST['id_convocatoria'];
    require_once('../modelo/evaluacion.php');
    $evaluacion = new Evaluacion();
    $post_requer = $evaluacion->obtenerClavePostReq($idMateria,$idPostulante);
    $evaluacionMeritos = $_POST['notaMeritoFinal'];
    $evaluacionMeritos = intval($evaluacionMeritos);
    $evaluacionConocimientos = $_POST['finalEConocimiento'];
    $evaluacionConocimientos = intval($evaluacionConocimientos);
    $notaTotalCM = $_POST['notaTotalCM'];
    $notaTotalCM = intval($notaTotalCM);
    $res = $evaluacion->insertarNotasPostulante($post_requer['post_requis'],$evaluacionMeritos,$evaluacionConocimientos,$notaTotalCM);
    header("Location:../paginas/indexEvaluador.php");
?>
                