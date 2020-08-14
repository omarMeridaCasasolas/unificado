<?php
    session_start();
    if(isset($_SESSION['nombreEvaluador'])  &&  isset($_SESSION['idEvaluador'])){
        $nombreEvaluador = $_SESSION['nombreEvaluador'];
        $idEvaluador = $_SESSION['idEvaluador'];
    }else{
        header("Location:comisionEvaluadora.php?error=x");
    }
?>

<?php
    if(isset($_GET['idPost']) && isset($_GET['idMat']) && isset($_GET['idConv'])){
        $idPost = $_GET['idPost'];
        $idMat = $_GET['idMat'];
        $idConv = $_GET['idConv'];
        //session_start();
    }else{
        echo "Error con los datos";
    }
?>



<!DOCTYPE html>
  <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="../img/imagenes/icon.gif" type="image/gif">
      <script src="../librerias/js/popper-1.14.7.min.js"></script>    
      <link rel="stylesheet" href="../librerias/css/bootstrap.min.css">    
      <link rel="stylesheet" href="../librerias/css/styles.css">
      <link rel="stylesheet" href="../librerias/css/slick.css">
      <link rel="stylesheet" href="../librerias/css/slick-theme.css">
      <link rel="stylesheet" href="../librerias/css/cabeceraCss.css">
      <link rel="alternate" type="application/rss+xml" title="Avisos de Inform&aacute;tica - Sistemas (UMSS)" href="../rss/index.rss">
      <script src="../librerias/js/jquery-3.3.1.min.js"></script>
      <script src="../librerias/js/bootstrap.min.js"></script>
      <script src="../librerias/archivos/script.js"></script>
      <script src="../librerias/js/slider.js"></script>
      <script src="../librerias/js/slick.js"></script>
      <script src="../librerias/archivos/jquery.snow.js"></script>
    <title>Revision de documentos</title>
    <link rel="stylesheet" href="../style/bootstrap.css">
    <link rel="stylesheet" href="../style/myStyle.css">
</head>
<body>

    <div>    
          <nav class="navbar navbar-expand-lg navbar-custom padding-navbar">
            <div class="container">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navegacion,#navegacion2" aria-controls="navegacion" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>     
              </button>
              <div class="collapse navbar-collapse" id="navegacion">
                <ul id="sub-header2" class="navbar-nav mr-auto">
                  <li id="menu2" class="nav-item">
                    <a class="nav-link" href="../index.php">
                    INICIO
                    </a>
                  </li>
                  
                  <li id="menu2" class="nav-item">
                    <a class="nav-link" href="../formularios/form_cerrarSession.php" class="float-right text-light">CERRAR SESION</a>
                  </li>
                  
                </ul>           
                <span class="navbar-text">
                    <script> fecha(); </script>
                </span>
                
              </div>
            </div>
          </nav>
          
          <header class='p-3 navbar navbar-expand-lg navbar-custom padding-navbar'>
            <h3 class='text-light'>Bienvenido <?php echo $nombreEvaluador; ?></h3>
            <!-- <a href="../formularios/form_cerrarSession.php" class="float-right text-light">cerrar session</a> -->
          </header>
    <div>
    <hr>

    <div class="container-fluid text-left">
        <?php 
           require_once('../modelo/documentos.php');
           $documento = new Documento();
           $asignatura = $documento->obtenerAsignaturaUnica($idMat);
           $destinoAsignatura;
           if(empty($asignatura['destino_requerimiento'])){
               $destinoAsignatura=$asignatura['nombre_auxiliatura'];
           }else{
               $destinoAsignatura=$asignatura['destino_requerimiento'];
           }
           $postulante = $documento->obtenerPostulanteUnico($idPost);
           $claveRelacion = $documento->obtenerClaveRelacion($idPost,$idMat);
           ?>
           <h2>Asignatura o materia: <?php echo $destinoAsignatura; ?></h2>
           <h3>Nombre del postulante: <?php echo $postulante['nombre_postulante']; ?></h3>
           <!--Enviar datos ocultos -->
       
           <form action="../formularios/procesarDocumentos.php" method="post" >
               <input type="text" class='invisible' name="idMateria" id="idMateria" value="<?php echo $idMat; ?>">
               <input type="text" class='invisible' name="idPostulante" id="idPostulante" value="<?php echo $idPost; ?>">
               <input type="text" class='invisible' name="idConvocatoria" id="idConvocatoria" value="<?php echo $idConv; ?>"> 
               <input type="text" class='invisible' name="post_materia" id="post_materia" value="<?php echo $claveRelacion['post_requis']; ?>"> 
           
       
       
       
       
               <h2>Lista de los documentos</h2>
               <table class='table table-hover'>
                   <thead>
                       <tr>
                           <th>Descripcion del documento</th>
                           <th>Evaluacion</th>
                           <th>Estado</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php
                           $existeDocumentacion = $documento->buscarDocumentacion($idMat,$idPost);   
                           if($existeDocumentacion){
                               //echo var_dump($existeDocumentacion);
                               foreach($existeDocumentacion as $documentoActual){
                                   $solution = $documento->obtenerDescripcionDocumento($documentoActual['id_documentos']); 
                                   if($solution){
                                       echo "<tr>
                                   <td>".$solution['descripcion_documento']."</td>
                                   <td>";
                                   if($documentoActual['evaluacion_documento']=="Entregado"){
                                       echo  "<select id='id_".$documentoActual['id_documentos']."' name='id_".$documentoActual['id_documentos']."' class='p-1 propiedad'>Documento
                                      <option value='Sin revision'>Sin revision</option>
                                       <option value='Entregado' selected>Entregado</option>
                                       <option value='No entregado'>Falta</option>
                                       </select> ";
                                       echo  "</td>
                                       <td><h6 id='estado_".$documentoActual['id_documentos']."' class='bg-success py-1 text-center'>Entregado</h6><td>
                                   <tr>";
                                   }else{
                                       if($documentoActual['evaluacion_documento']=="No entregado"){
                                           echo  "<select id='id_".$documentoActual['id_documentos']."' name='id_".$documentoActual['id_documentos']."' class='p-1 propiedad'>Documento
                                           <option value='Sin revision'>Sin revision</option>
                                               <option value='Entregado' >Entregado</option>
                                               <option value='No entregado' selected>Falta</option>
                                               </select>";
                                               echo  "</td>
                                               <td><h6 id='estado_".$documentoActual['id_documentos']."' class='bg-danger py-1 text-center'>No entregado</h6><td>
                                               <tr>";
                                       }else{
                                           echo  "<select id='id_".$documentoActual['id_documentos']."' name='id_".$documentoActual['id_documentos']."' class='p-1 propiedad'>Documento
                                           <option value='Sin revision' selected>Sin revision</option>
                                               <option value='Entregado'>Entregado</option>
                                               <option value='No entregado' >Falta</option>
                                               </select>";
                                               echo  "</td>
                                               <td><h6 id='estado_".$documentoActual['id_documentos']."' class='bg-warning py-1 text-center'>Sin revision</h6><td>
                                               <tr>";
                                       }
                                   }
                                   }
                                   
                                   $valores[] ="id_".$documentoActual['id_documentos'];
                               }
                           }else{
                               $listaDocumentos = $documento->obtenerListaDocumentos($idConv);
                               $valores = array();
                               foreach($listaDocumentos as $documentoActual){
                                   echo "<tr>
                                       <td>".$documentoActual['descripcion_documento']."</td>
                                       <td>
                                           <select id='id_".$documentoActual['id_documentos']."' name='id_".$documentoActual['id_documentos']."' class='p-1 propiedad'>Documento
                                           <option value='Sin revision'>Sin revision</option>
                                               <option value='Entregado'>Entregado</option>
                                               <option value='No entregado'>Falta</option>
                                           </select>
                                       </td>
                                       <td><h6 id='estado_".$documentoActual['id_documentos']."' class='bg-warning py-1 text-center'>Sin revision</h6><td>
                                       <tr>";
                                   $valores[] ="id_".$documentoActual['id_documentos'];
                               } 
                           }         
       
                           $_SESSION['claves'] = $valores;
                           
                       ?>
                   </tbody>
               </table>  
                       
                       <input type="submit" value="Terminal evaluacion" class='btn btn-primary'>
        </form>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $('.propiedad').change(function (e) { 
                    let tmp = this.id;
                    let arreglo = tmp.split("_");
                    let salida = $("#id_"+arreglo[1]+" option:selected").text();
                    if(salida == "Sin revision"){
                        $("#estado_"+arreglo[1]).removeClass('bg-success');
                        $("#estado_"+arreglo[1]).removeClass('bg-danger');
                        $("#estado_"+arreglo[1]).addClass('bg-warning');
                    }else{
                        if(salida == "Entregado"){
                            $("#estado_"+arreglo[1]).removeClass('bg-warning');
                            $("#estado_"+arreglo[1]).removeClass('bg-danger');
                            $("#estado_"+arreglo[1]).addClass('bg-success');
                        }else{
                            $("#estado_"+arreglo[1]).removeClass('bg-success');
                            $("#estado_"+arreglo[1]).removeClass('bg-warning');
                            $("#estado_"+arreglo[1]).addClass('bg-danger');
                        }
                    }
                    $("#estado_"+arreglo[1]).html(salida);
                    console.log(salida);
                    e.preventDefault();          
                });
                /*
                let cadena1= "Sin revision";
                let bandera = $(".propiedad option:selected").text();
                if(bandera != cadena1){
                    console.log('Aqui');
                }*/
            });
        </script> 
    </div>               
</body>
</html>