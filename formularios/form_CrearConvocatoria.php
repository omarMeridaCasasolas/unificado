<?php  
    session_start();
    $tituloConvocatoria = $_POST['idTitulo'];
    $gestionConvocatoria = $_POST['gestionConvocatoria'];
    $departamentoConvocatoria = $_POST['departamentoConvocatoria'];
    $descripcionConvocatoria = $_POST['descripcionConvocatoria'];
    require_once('../modelo/convocatoriaUnica.php');
    $convocatoria = new ConvocatoriaUnica();
    $respuesta = $convocatoria->crearConvocatoria($tituloConvocatoria,$gestionConvocatoria,$departamentoConvocatoria,$descripcionConvocatoria,true);
    $_SESSION['claveConvocatoria'] = $respuesta; 
    var_dump($respuesta);
    header("Location:../paginas/requerimientosAuxiliarDocencia.php");
    /*
    if(isset($_POST['idTitulo']) && isset($_POST['gestionConvocatoria']) && isset($_POST['departamentoConvocatoria']) && isset(_POST['descripcionConvocatoria'])){
        session_start();
        $tituloConvocatoria = $_POST['idTitulo'];
        $gestionConvocatoria = $_POST['gestionConvocatoria'];
        $departamentoConvocatoria = $_POST['departamentoConvocatoria'];
        $descripcionConvocatoria = $_POST['descripcionConvocatoria'];
        require_once('../modelo/convocatoriaUnica.php');
        $convocatoria = new ConvocatoriaUnica();
        $respuesta = $convocatoria->crearConvocatoria($tituloConvocatoria,$gestionConvocatoria,$departamentoConvocatoria,$descripcionConvocatoria,true);
        $_SESSION['claveConvocatoria'] = $respuesta; 
        header("Location:../paginas/requerimientosDocencia.php");
    }else{
        header("Location:../paginas/CRUD_publicaciones.php?error=x");
    }
    */
?>