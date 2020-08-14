<?php 
    session_start();
    if($_SESSION['claves']){
        $claveRequerimiento = $_SESSION['claves'];
        $idMateria = $_POST['idMateria'];
        $idPostulante = $_POST['idPostulante'];
        $idConvocatoria = $_POST['idConvocatoria'];
        $postulante_materia = $_POST['post_materia'];
        //echo $idMateria."--".$idPostulante."--".$idConvocatoria."<br>";
        //echo var_dump($claveRequerimiento);
        require_once('../modelo/documentos.php');
        $documento = new Documento();
        $bandera = true;
        foreach ($claveRequerimiento as $documento_postulante){
            //echo $documento_postulante."<br>";
            $temporal = $_POST[$documento_postulante];
            if($temporal != "Entregado"){
                $bandera = false;
            }
            $idDocumento = explode("_",$documento_postulante);
            $respuesta = $documento->ingresarTablaEvaluacion_documentos($idDocumento[1],$idMateria,$idPostulante,$postulante_materia,$temporal);
        }
        if($bandera){
            $documento->documentosAceptados($postulante_materia);
        }
        header("Location:../paginas/indexEvaluador.php");
    }else{
        echo "error al procesar informacion";
    }
?>