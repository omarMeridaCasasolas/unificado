<?php
    session_start();
    if(isset($_SESSION['claveConvocatoria'])){
        $clavePrimaria = $_SESSION['claveConvocatoria'];
        require_once('../modelo/convocatoriaUnica.php');
        $convocatoria = new ConvocatoriaUnica();
        
    }else{
        echo "No existe variable session";
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requisitos y Requerimientos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <main class="container">

        <h2>Requerimientos</h2>
            <table id="tableRequerimientos" class="table table-hover" border=1>
                <thead>
                    <tr class='text-center'>
                        <th style="width:15%;">CANTIDAD</th>
                        <th style="width:20%;">HRS. ACADEMICAS</th>
                        <th style="width:45%;">DESTINO</th>
                        <th style="width:20%;">OPCIONES</th>
                    </tr>
                </thead>
                <tbody id="listaRequerimientos">
                </tbody>
            </table>
            <form id="formAgregarRequerimeinto">
                
                <div class="d-flex">
                    <div style="width:15%;" ><input type="text" id="idCantidad" class="form-control"></div>
                    <div style="width:20%;" ><input type="text" id="idHoras" class="form-control"></div>
                    <div style="width:45%;" ><input type="text" id="idDestino" class="form-control"></div>
                    <div style="width:20%;" class='text-center'><input type="submit" class="btn btn-success" value="+ Requerimiento" id="AddRequerimientos"></div>
                </div>
                <input type="text" id="idConvocatoria" value="<?php echo $_SESSION['claveConvocatoria']; ?>">
            </form>

            <hr>
            <form action="../formularios/requerimietosAuxDocencia.php" method="post">
                <div class="text-center">
                    <input type="submit" class='btn btn-primary' value="Agregar">
                </div>
            </form>

        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" id="ventanaModal" data-toggle="modal" data-target="#myModal">
        Open modal
        </button>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form >
                        <h3 class='text-center mb-2'>Actualizar requerimiento</h3>
                        <input type="text" name="" id="claveReqEspecifica">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">Cantidad</label>
                                <input type="text" name="" id="cantidadActualizar" class='form-control'>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Horas academicas</label>
                                <input type="text" name="" id="horasActualizar" class='form-control'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Destino</label>
                            <input type="text" name="" id="destinoActualizar" class='form-control'>
                        </div>
                        <div class="text-center"> 
                            <button type="button" class='btn btn-primary submitBtn'  id="actulizarRequerimientos">Actualizar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarModal">Close</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <h2>Requisitos</h2>
        <table class='table table-hover'>
            <thead>
                <tr class='text-center'>
                   <th style="width:75%;">Descripcion</th>
                   <th style="width:25%;">Opciones</th>
                </tr>
            </thead>
            <tbody id="listaDocumentos">

            </tbody>
        </table>
            <form id="formDocumentos" method="POST">
                <h4>Escriba documentos</h4>
                <div class="row">
                    <div class="col-9">
                        <textarea name="iDdocument" id="iDdocument" rows="4" style="width:100%;" required></textarea>
                    </div>
                    <dic class="col-3 text-center">
                        <input type="submit" class='btn btn-success' value="Agregar">
                    </dic>
                </div>
            </form>
    </main>
        <div class="text-center m-5">
        <a href="presentacionDocencia.php" class='btn btn-info'>Siguiente</a>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="requerimientosConvocatoria.js"></script>
</body>
</html>