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
    </head>
    <body>

        <?php
            if(isset($_GET['dato'])){
                $valor=$_GET['dato'];
                echo "<script>";
                if($valor=='x'){
                echo    "alert('Se ha enviado su contraseña a su correo');";
                }else{
                    if($valor=='y'){
                     echo  "alert('Usuario no encontrado');";
                    }else{
                        echo  "alert('Error al  evaluar la sentencia');";
                    }
                }
                echo "</script>";
            }
        ?>

      <header>        
        <div>    
          <nav class="navbar navbar-expand-lg navbar-custom padding-navbar">
            <div class="container">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navegacion,#navegacion2" aria-controls="navegacion" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>     
              </button>
              <div class="collapse navbar-collapse" id="navegacion">
                <ul id="sub-header2" class="navbar-nav mr-auto">
                  <!-- <li id="menu2" class="nav-item">
                    <a class="nav-link" href="../index.php">
                    INICIO
                    </a>
                  </li> -->
                  
                  
                </ul>           
                <span class="navbar-text">
                    <script> fecha(); </script>
                </span>
                
              </div>
            </div>
          </nav> 
        <div>


        <div class="d-sm-none d-md-block d-none d-lg-block cabeceraCss">
                          <div class="cabeceraCssAzul"></div>
                          <div class="cabeceraCssAzulClaro"></div>
                          <div class="cabeceraCssBlanca"></div>
                          <div class="textoCabecera h3">SISTEMA DE ADMINISTRACION DE CONVOCATORIAS DE AUXILIARES</div>
                          <img class="logoUmssCss" src="../img/imagenes/LogoUMSS.png" alt="UMSS"> 
                          
        </div> 
        </div>                 
        
        <div>
    
          <div id="navbar-color" class="container-fluid">
              <div class="row">
                  <div class="col-md-12 p-0">
                    <nav class="navbar navbar-expand-lg navbar-light navbar-guest padding-navbar">
                      <div class="collapse navbar-collapse" id="navegacion2"> 
                        <ul id="sub-header" class="nav navbar-nav nav-justified w-100">
                          
                          <li id="menus" class="nav-item">
                            <a class="nav-link" href="../index.php">
                            INICIO
                            </a>
                          </li>
                          
                          <li id="menus" class="nav-item">
                              <a class="nav-link" href="../paginas/login.php">
                                SESI&Oacute;N ADMINISTRATIVO
                              </a>
                          </li> 

                          <li id="menus" class="nav-item">
                              <a class="nav-link" href="../paginas/postulante.php">
                                SESI&Oacute;N POSTULANTE 
                              </a>
                          </li>

                          <li id="menus" class="nav-item">
                              <a class="nav-link" href="../paginas/comisionEvaluadora.php">
                                SESI&Oacute;N COMISION EVALUADORA 
                              </a>
                          </li>
                          
                          <li id="menus" class="nav-item">
                              <a class="nav-link" href="../paginas/buscarConvocatorias.php">
                                BUSCAR CONVOCATORIA
                              </a>
                          </li>

                        </ul>
                      </div>
                    </nav>
                  </div>
              </div>
          </div>
        </div>
        <!-- <script>
            $(function(){
              var url = window.location.href; 
      
              $("#sub-header2 a").each(function() {
                      // checks if its the same on the address bar
                  if(url == (this.href)) { 
                      $(this).closest("li").addClass("active");
                  }
              })
            });
        </script> -->
        </div>
      </header>
      
      <?php
        if(isset($_GET['error'])){
          echo "<script>";
          echo    "alert('Error al autentificar');";
          echo "</script>";
          }
      ?>


      <div class="container-fluid text-center">
        <div class="row content">          
          <div id="body" class="col-sm-12 text-left">
            <hr>
            <div class="container-fluid">
              <div>
                <h2 class="p-2 text-center">
                  <a>Autenticacion Administrativo</a>
                </h2>
                            <!-- Modal -->
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                    <div class="modal-body">
                                      <form action="../formularios/form_enviarEmail.php" method="post">
                                        <h4 class='text-center'>ENVIAR CONTRASEÑA</h4>
                                        <div class="form-group">
                                            <label for="reenvio_Pass">Correo Electronico: </label>
                                            <input type="email"  class="form-control" name="reenvio_Pass" id="reenvio_Pass" required placeholder="ejemplo@gmail.com">
                                        </div>
                                        <div class="text-center">
                                          <button type="button" class="btn btn-warning " data-dismiss="modal">Cancelar</button>
                                          <input type="submit" class='btn btn-primary'value="Reenviar">
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                            </div>
                <hr>
                    <section class="principal">
                        <div class="border border-dark alert alert-primary w-50 mx-auto my-5 p3" role="alert">
                            <form action="../formularios/form_VerificarUsuario.php" method="post" class="rounded-sm">
                                <label class="font-italic d-block p-1" for="loginCorreo">Correo Electronico</label>
                                <input class="font-italic h4 d-block w-75 mx-auto p-2 rounded-sm" type="mail" name="IdUsuaario" id=""  autocomplete='off' id="loginCorreo" placeholder="Ejemplo@gmail.com">
                                <label class="font-italic d-block p-1" for="loginPass"> Contraseña</label>
                                <input class="font-italic h4 d-block w-75 mx-auto p-2 rounded-sm" type="password" name="IdPassword" id="loginPass" placeholder="****************" autocomplete='off'>
                                <input type="submit" value="Entrar" class="btn btn-success d-block mx-auto my-3">
                                <a href="#" data-toggle="modal" data-target="#myModal">Olvidaste tu contraseña</a>
                            </form>
                            
                        </div>
                    </section>
                <!-- </div> -->
            </div>        
        </div>
      </div>            
      
      
      
      <footer class="container-fluid text-center footer-guest">
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
    </div>
  </body>
  </html>