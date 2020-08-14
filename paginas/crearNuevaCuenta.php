<!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
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
    
    </head>
    <body>
        <?php /* include("../plantillas/header.php");*/?>

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
                                <a class="nav-link" href="Postulante.php">
                                Postulante
                                </a>
                            </li>
                            
                            </ul>           
                            <span class="navbar-text">
                                <script> fecha(); </script>
                            </span>
                            
                        </div>
                    </div>
        </nav>

        <div class="container p-2 border border-dark text-dark alert alert-primary mt-5 p-3" role="alert">
            <form action="../formularios/form_CrearPostulante.php" method="POST">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="nombrePostulante">Nombre completo: </label>
                        <input type="text" name="nombrePostulante" class="form-control" id="nombrePostulante" required pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" >
                    </div>
                    <div class="form-group col-6">
                        <label for="ciPostulante">Codigo de carnet: </label>
                        <input type="text" name="ciPostulante" class="form-control" id="ciPostulante" required pattern="[0-9]{6,10}">
                    </div>
                    <div class="form-group col-6">
                        <label for="correoPostulante">Correo Electronico</label>
                        <input type="email" name="correoPostulante" class="form-control" id="correoPostulante" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="telefonoPostulante">Telefono: </label>
                        <input type="password" name="telefonoPostulante" class="form-control" id="telefonoPostulante" pattern="[0-9]{7,8}" required>  
                    </div>
                    <div class="form-group col-6">
                        <label for="passPostulante">Password: </label>
                        <input type="password" name="passPostulante" class="form-control" id="passPostulante" pattern="^(?=.{4,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$" required>     
                    </div>
                    <div class="form-group col-6">
                        <label for="passRepeat">Repita su password: </label>
                        <input type="password" name="passRepeat" class="form-control" id="passRepeat" pattern="^(?=.{4,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$" required>  
                    </div>
                    <div class="col-12 text-center">
                        <input type="submit" class='btn btn-primary' value="Crear usuario">
                    </div>
                </div>
            </form>
        </div>

        <?php /* include("../plantillas/footer.php");*/?>

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