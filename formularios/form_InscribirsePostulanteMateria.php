<?php
    if(isset($_GET['id_post']) && isset($_GET['id_req'])){
        require_once("../modelo/convocatoria.php");  
        $convocatoria = new  Convocatoria();
        $convocatoria->inscribirPostulanteMateria($_GET['id_post'],$_GET['id_req']);
        header("Location:../paginas/index_postulante.php");
    }else{
        echo "No se puede procesar la informacion";
        header("Location:../paginas/index_postulante.php");
    }

