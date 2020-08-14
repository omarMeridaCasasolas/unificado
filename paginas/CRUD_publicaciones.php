<?php
    session_start();
    $var=$_SESSION['sesion'];
    if($var == null || $var = '' ){
        echo "Erro al autentificar";
        header("Location:index.php?error=x");
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
      <title>SISTEMA ADMINISTRACION DE CONVOCATORIAS DE AUXILIARES</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      <!--<link rel="stylesheet" href="../style/bootstrap.css">
      <link rel="stylesheet" href="../style/myStyle.css">-->
      <style type="text/css">
        #nuevaConvocatoria:link
        {
        text-decoration:none;
        }
      </style>
        <script src="https://kit.fontawesome.com/d848ccec99.js" crossorigin="anonymous"></script>
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
                                    <a class="nav-link" href="../paginas/cambiarEmailPassword.php">
                                    CAMBIAR CONTRASEÑA
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

    <header class="p-3 navbar navbar-expand-lg navbar-custom padding-navbar">
    <h3 class="font-italic text-light"><i class="fas fa-users"></i>
            <?php
                if(isset($_SESSION['sexoUsuario'])){
                    $sexo=$_SESSION['sexoUsuario'];
                    if($sexo=="Hombre"){
                        echo "Bienvenido ";
                        if(isset($_SESSION['cargoUsuario'])){
                            $cargo=$_SESSION['cargoUsuario'];
                            if($cargo=="Administrador"){
                                echo "Administrador ";
                            }else{
                                if($cargo=="Secretaria"){
                                    echo "Secretario ";
                                }
                            }
                        }
                    }else{
                        echo "Bienvenida ";
                        if(isset($_SESSION['cargoUsuario'])){
                            $cargo=$_SESSION['cargoUsuario'];
                            if($cargo=="Administrador"){
                                echo "Administradora ";
                            }else{
                                if($cargo=="Secretaria"){
                                    echo "Secretaria ";
                                }
                            }
                        }
                    }
                }else{
                    echo "Bienvenid@";
                }
            echo $_SESSION['sesion'];

            $extension=" ";
            if($_SESSION['bandera']){
                $extension="asc";
                $_SESSION['bandera']=false;
            }else{
                $extension="  ";
                $_SESSION['bandera']=true;
            }

            ?>
        </h3>
        <!--<a href="../paginas/cambiarEmailPassword.php" class="float-right text-light">Cambiar Contraseña</a>
        <br>
        <a href="../formularios/form_cerrarSession.php" class="float-right text-light">cerrar session</a>-->
    </header>
    <?php
                if(isset($_GET['tit']) && isset($_GET['color'])){ ?>

                    <div class="container w-50 pt-2">
                        <div class='alert alert-<?php echo $_GET['color'];?>  alert-dissmisible fade show' role='alert'>
                            <?php echo $_GET['tit'];?>
                            <button type='button' class='close' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times;</span></button>

                        </div>
                    </div>
                <?php
            }?>
    <main class='container-fluid mt-2'>
        <!--<a href="convocatoria_personalizada.php">AJax convocatoria</a> -->
        <div class="row">
          <div class='col-10 p-5 table-responsive'>
            <table class='table table-hover'>
                <h4>Lista de convocatoria</h4>
                <a href='crearPublicacion.php' class='btn btn-success p-2 rounded-lg m-2' id='nuevaConvocatoria'>Crear nueva convocatoria</a>
                    <thead class='bg-primary'>
                        <tr>
                            <th><a href="CRUD_publicaciones.php?convocatoria=<?php echo $extension ?>" class="btn btn-dark">Convocatoria &#8597;</a></th>
                            <th><a href="CRUD_publicaciones.php?autor=<?php echo $extension ?>" class="btn btn-dark">Autor &#8597;</a></th>
                            <th><a href="CRUD_publicaciones.php?fecha=<?php echo $extension ?>" class="btn btn-dark">Fecha de creacion &#8597;</a></th>
                            <th>PDF</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once("../modelo/convocatoria.php");
                    $convocatoria = new Convocatoria();
                    $resultado=$convocatoria->mostrarConvocatoriaFechaDescendente();
                    if(isset($_GET['fecha'])){
                        $fecha=$_GET['fecha'];
                        if($fecha=='asc'){
                            $resultado=$convocatoria->mostrarTodasConvocatoriaFechaDescendente();
                        }else{
                            $resultado=$convocatoria->mostrarTodasConvocatoriaFechaAscendente();
                        }
                    }
                    if(isset($_GET['convocatoria'])){
                        $myConvocatoria=$_GET['convocatoria'];
                        if($myConvocatoria=='asc'){
                            $resultado=$convocatoria->mostrarTodasConvocatoriaNombreDescendente();
                        }else{
                            $resultado=$convocatoria->mostrarTodasConvocatoriaNombreAscendente();
                        }
                    }
                    if(isset($_GET['autor'])){
                        $autor=$_GET['autor'];
                        if($autor=='asc'){
                            $resultado=$convocatoria->mostrarTodasConvocatoriaAutorDescendente();
                        }else{
                            $resultado=$convocatoria->mostrarTodasConvocatoriaAutorAscendente();
                        }
                    }
                    foreach($resultado as $elemento){
                            echo "<tr>";
                            echo    "<td><h6>".$elemento['tipo_convocatoria']."</h6>".$elemento['gestion_convocatoria']."</td>";
                            echo    "<td><h6>".$elemento['autor_convocatoria']."</h6></td>";
                            echo    "<td><h6>".$elemento['fecha_subida']."</h6></td>";
                            echo    "<td>";
                            echo        "<a  href='".$elemento['direccion_pdf']."' target='_blank'>Abrir ".$elemento['tipo_convocatoria']."</a>";
                            echo    "</td>";
                            echo    "<td>";
                            echo        "<a href='../formularios/form_eliminarConvocatoria.php?id=".$elemento['id_convocatoria']."'  class='btn btn-danger' title='Eliminar convocatoria'><i class='fas fa-trash-alt'></i></a>
                                        <a href='listaPostulantes.php?id=".$elemento['id_convocatoria']."' class='btn btn-info' title='Lista de postulantes'><i class='fas fa-user-tie'></i></a>
                                </td>
                            </tr>";
                        }
                    echo "</tbody>
                </table>
            </div>
        </div>
    </main>";

    ?>

    <footer class="container-fluid text-center footer-guest">
            <!DOCTYPE html>
            <hr>
            <div class="container col-xs- col-sm- col-md-12 col-log-">
                            <div class="text-center">
                                <h6 class="d-inline-block">Contacto: <a href="">correo_del_Administardor@mail.com ,</a> <a href="">  correo_de_la_Empresa@mail.com</a></h6>
                                <h6 class="d-inline-block">Telefono: (+591) 72584871 Administrador, (+591) 77581871 Secretaria</h6 >
                            </div>
                            <div class="text-center">
                                <h6>Sitios Relacionados :
                                    <a href="http://www.umss.edu.bo/" target="_blank">UMSS</a>
                                    <a href="http://websis.umss.edu.bo/" target="_blank"> | WEBSISS</a>
                                    <a href="https://www.facebook.com/UmssBolOficial" target="_blank"> | facebook</a>
                                    <a href="https://twitter.com/UmssBolOficial" target="_blank"> | Twitter</a>
                                    <a href="https://www.instagram.com/umssboloficial/" target="_blank"> | Instagram</a>
                                    <a href="https://www.linkedin.com/school/universidad-mayor-de-san-simon/" target="_blank"> | Linkedin</a>
                                    <a href="https://www.youtube.com/universidadmayordesansimon" target="_blank"> | Youtube</a>
                                </h6>
                            </div>
                            <div class="text-center">
                                <h6>Derechos Reservados © 2020 · Universidad Mayor de San Simón.</h6>
                            </div>
                        </div>
            <div><br></div>
        </footer>
        <!--La libreria jquery.snow.js es obsoleta(21-01-2012)se sugiere poner un nav especifico para estas fechas-->
        <script>
            $(document).ready( function(){
            var date = new Date();
            if(date.getMonth()==11){
                $.fn.snow({
                    minSize: 10, //Tamaño mínimo del copo de nieve, 10 por defecto
                    maxSize: 20, //Tamaño máximo del copo de nieve, 10 por defecto
                    newOn: 1000, //Frecuencia (en milisegundos) con la que aparecen los copos de nieve, 500 por defecto
                    flakeColor: '#FFFFFF' //Color del copo de nieve, #FFFFFF por defecto
                });
            }
            });
            ajustarFooter();
        </script>
</body>

</html>
