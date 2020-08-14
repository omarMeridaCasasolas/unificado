<?php
    //session_start();
    $idPost = $_SESSION['id_post'];
    $idMat = $_SESSION['id_mat'];
    require_once('../modelo/postulante.php');
    $postulante = new Postulante();
    $respuesta = $postulante->obtnerDatosPostulante($idPost);
    require_once('../modelo/convocatoria.php');
    $convocatoria = new Convocatoria();
    $datosReq = $convocatoria->mostrarMateriaCompleta($idMat);   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <style>
            *{ font-family: 'Open Sans';
            font-style: normal;
            font-weight: normal;}
        </style>
</head>
<body>
    <h3 class='text-center'>Datos oficiales del postulante</h3>
    <h6><b>Nombre del postulante: </b> <?php echo $respuesta['nombre_postulante']; ?></h6> 
    <h6><b>Carnet de indetidad: </b> <?php echo $respuesta['ci_postulante']; ?></h6> 
    <h6><b>Correo electronico: </b> <?php echo $respuesta['correo_postulante']; ?></h6>  
    <h6><b>Telefono postulante: </b> <?php echo $respuesta['telefono_postulante']; ?></h6>   
    <h3 class='text-center'>Informacion a la postulacion</h3>
    <?php foreach($datosReq as $requerimiento){
        $conv= $convocatoria->mostrarConvocatoriaCompleta($requerimiento['id_convocatoria']);
        $elemento = $conv[0];
        echo $elemento['nombre_convocatoria'];
        echo "<h6><b>Titulo de la convocatoria: </b>".$elemento['nombre_convocatoria']."</h6>";
        echo "<h6><b>Gestion: </b>".$elemento['gestion_convocatoria']."</h6>";
        $tipoConvocatoria = $elemento['tipo_convocatoria'];
        if($tipoConvocatoria == 'Auxiliatura de Docencia'){
            echo "<h6>Nombre de la Auxiliatura: ".$requerimiento['destino_requerimiento']."</h6>";
        }else{
            echo "<h6><b>Codigo auxiliatura: </b>".$requerimiento['codigo_auxiliatura']."</h6>";
            echo "<h6>Nombre de la Auxiliatura: ".$requerimiento['nombre_auxiliatura']."</h6>";
        }
    }   
    ?>     
</body>
</html>