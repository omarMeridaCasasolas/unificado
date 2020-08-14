<?php
    session_start();
    $var=$_SESSION['nombre_postulante'];
    if($var == null || $var = '' ){
        echo "Erro al autentificar";
        header("Location:../index.php?error=x");
    }
    if(isset($_GET['id_conv'])){
        $id_convocatoria = $_GET['id_conv'];
    }else{
        header("Location:../paginas/indexPostulante.php?error=y");
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
      <title>Convocatoria UMSS</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../style/bootstrap.css">
      <link rel="stylesheet" href="../style/myStyle.css">
    </head>
<body>
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
                        <a class="nav-link" href="../formularios/form_cerrarSession.php">
                            CERRAR SESION
                        </a>
                  </li>
                  
                  
                </ul>           
                <span class="navbar-text">
                    <script> fecha(); </script>
                </span>
                
              </div>
            </div>
    </nav>
    <hr>
    <!-- <div class="container-fluid">
        <div class="row"> --> <!-- col-7 p-5 -->
                <div class="container-fluid text-left">
                    <div class="border border-dark alert alert-primary">    
                    <?php
                        require_once("../modelo/convocatoria.php");  
                        $convocatoria = new  Convocatoria();
                        $tipoConvocatoria = $convocatoria->mostrarConvocatoriaUnica($id_convocatoria);
                        $materias = $convocatoria->mostrarMateriasDisponibles($id_convocatoria);
                        if($tipoConvocatoria['tipo_convocatoria'] == 'Auxiliatura de laboratorio'){
                            foreach($materias as $materia){
                                echo "<h2>Nombre de la Auxiliatura</h2>";
                                echo "<h4>".$materia['nombre_auxiliatura']."</h4>";
                                $contexto = $convocatoria->materiaInscrita($_SESSION['id_postulante'],$materia['id_requerimiento']);
    
                                if($contexto){ ?>
                                    <a href="../formularios/form_eliminarPostulanteMateria.php?id_post=<?php echo $_SESSION['id_postulante']; ?>&id_req=<?php echo $materia['id_requerimiento'];?>" class="btn btn-danger">Eliminar</a>
                                    <hr>
                                <?php 
                                }else{
                                    ?>
                                    <a href="../formularios/form_InscribirsePostulanteMateria.php?id_post=<?php echo $_SESSION['id_postulante']; ?>&id_req=<?php echo $materia['id_requerimiento'];?>" class="btn btn-primary">Inscribirse</a> 
                                    <hr>
                                <?php
                                }
                            }
                        }else{
                            foreach($materias as $materia){
                                echo "<h2>Nombre de la Materia</h2>";
                                echo "<h4>".$materia['destino_requerimiento']."</h4>";
                                $contexto = $convocatoria->materiaInscrita($_SESSION['id_postulante'],$materia['id_requerimiento']);
                                if($contexto){ ?>
                                    <a href="../formularios/form_eliminarPostulanteMateria.php?id_post=<?php echo $_SESSION['id_postulante']; ?>&id_req=<?php echo $materia['id_requerimiento'];?>" class="btn btn-danger">Eliminar</a>
                                    <hr>
                                <?php 
                                }else{
                                    ?>
                                    <a href="../formularios/form_InscribirsePostulanteMateria.php?id_post=<?php echo $_SESSION['id_postulante']; ?>&id_req=<?php echo $materia['id_requerimiento'];?>" class="btn btn-primary">Inscribirse</a> 
                                    <hr>
                                <?php
                                }
                            }
                        }
                    ?>
                    </div>
                </div>
        <!-- </div>
    </div> -->  
</body>
</html>