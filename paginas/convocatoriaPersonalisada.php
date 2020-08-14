<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convocatoria UMSSS</title>
    <link rel="stylesheet" href="../style/bootstrap.css">
    <link rel="stylesheet" href="../style/myStyle.css">
    <!--<script src="../style/scriptConcatoria.js"></script> -->
</head>
<body>
    <main class="container-fluid">
        <form action="../formularios/generarPDF.php" method="post"></form>
        <h1 class="text-center m-4">Convocatoria personalizada</h1>

                    <form id="formCreateConvocatoria">
                        <div class="row">        
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12 form-group">
                                        <label for="titulo">Escriba un Titulo</label>
                                        <input type="text" required name="titulo" id="titulo" placeholder="Titulo" class="form-control">
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="gestion"> Escriba la gestion</label>
                                        <input type="text" required name="gestion" id="gestion" placeholder="Gestion" class="form-control">
                                    </div>
                                    <div class="col-11 ml-3 form-control">
                                        <label for="departamento">Selecionar departamento: </label>
                                            <select name="departamento" id="departamento" class="form-control">
                                            </select>
                                    </div>          
                                </div>
                            </div> 
                            <div class="col-6">
                                <h3 class="center">Descripcion de la convocatoria</h3>
                                <textarea id="descripcionConv"  name="descripcionConv" rows="8" style="resize:none; width:100%;"></textarea>
                            </div>                             
                        </div>
                        <input type="text" name="usuarioDev" id="usuarioDev" value="Isabel mamani">
                        <input type="text" name="fechaDeCreacion" id="fechaDeCreacion" value="<?php date_default_timezone_set('America/La_Paz');
                                                                                    $_SESSION['clavePrimaria']=date("ymdHis") ;echo $fechaActual=date("Y-m-d H:i:s");?>">
                        <input type="text" name="cPrimary" id="cPrimary" value="<?php echo $_SESSION['clavePrimaria']; ?>" >
                        <div class="text-center m-4">  
                            <button  class="btn btn-success" type="submit">Crear Convocatoria</button>
                        </div>  
                    </form>

                <!--Ventana Model Requerimientos-->
                <div id="ex1" class="modal">
                    <form>
                    <h1 class="text-center mb-4">Editar requerimiento</h1>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="req_items">Items</label>
                                <input class="text-center p-1" type="number" name="req_items" id="req_items" class="text-center" placeholder="cantidad">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="req_cant">Cantidad</label>
                                <input class="text-center p-1" type="text" name="req_cant" id="req_cant">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="req_horas">Horas Academicas</label>
                                <input class="text-center p-1" type="text" name="req_horas" id="req_horas">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="req_cod">Codigo</label>
                                <input class="text-center p-1" type="text" name="req_cod" id="req_cod">
                            </div>
                            <div class="w-100 mb-2">
                                <h4 class="text-center">Nombre de la materia</h4>
                                <textarea name="req_name" id="req_name" style="width:100%; resize: none;"></textarea>
                            </div>
                        </div>

                        <div class="text-center pt-3">
                            <input type="button" class="btn btn-primary" value="Actualizar">
                            <a href="#" class="btn btn-danger" rel="modal:close">Close</a>
                        </div>
                    </form>
                </div>
                <p><a href="#ex1" rel="modal:open" id="modalAnchor"></a></p>

                <!-- Requerimientos -->
                <div class="Requerimientos">
                    <form id="formCreateRequerimiento">
                    <h3>Requerimientos</h3>
                    <table id="tablaReq" class="table table-hover" border="2">
                        <thead class="thead-dark">
                            <tr>
                                <th class="col-1 text-center">Items</th>
                                <th class="col-1 text-center">Cantidad</th>
                                <th class="col-2 text-center">Hora Academicas</th>
                                <th class="col-5 text-center">Nombre Auxiliatura</th>
                                <th class="col-2 text-center">Codigo de la Auxiliatura</th>
                                <th class="col-1 text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="listaRequerimiento">
                            <tr id="inputRequerimientos">
                                <td><input type="number"  name="itemsConvocatoria" id="itemsConvocatoria" class="w-100 text-center"></td>
                                <td><input type="text" name="cantRequermiento" id="cantRequermiento" class="w-100 text-center"></td>
                                <td><input type="text" name="horasAcademicas" id="horasAcademicas" class="w-100 text-center"></td>
                                <td><input type="text" name="nombreAuxiliatura" id="nombreAuxiliatura" class="w-100 text-center"></td>
                                <td><input type="text" name="codigoAuxiliatura" id="codigoAuxiliatura" class="w-100 text-center"></td>
                                <td><button class="btn btn-success" type="submit">Requerimiento</button> </td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                </div>

                <!--Ventana model de requisitos -->
                <div id="ex2" class="modal">
                    <form id="formActualizarRequisito">
                    <h1 class="text-center">Actualizar requisitos</h1>
                        <div>
                            <label for="FindRequi">Indice del requisito: </label>
                            <input type="text" name="FindRequi" id="FindRequi">
                        </div>
                        <h3 class="text-center">Descripcion del requisito</h3>
                        <textarea name="FdesRequi" id="FdesRequi" rows="15" style="width:100%; resize: none;"></textarea>
                        <div class="text-center pt-2">
                            <input type="submit" class="btn btn-primary" value="Actualizar Requisito">
                            <a  id="cerrarRequisitos" href="#" class="btn btn-danger" rel="modal:close">Close</a>
                        </div>
                    </form>
                </div>

                <p><a href="#ex2" rel="modal:open" id="modalRequisito" >Ventana 2</a></p>

                <!--requisitos-->
                <div class="requisitos">
                    <h1>Requisitos</h1>
                    <table class="table table-hover" border="2">
                        <thead>
                            <tr class="thead-dark">
                                <th class="col-1 text-center">Indice</th>
                                <th class="col-9 text-center">Descripcion del requisito</th>
                                <th class="col-1 text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tableRequisitos">
                        </tbody>
                    </table>
                    <form id="formRequisitos">
                        <h3>Escribe descripcion del requesito</h3>
                        <div class="row m-2">
                            <textarea class="col-10 mr-2" name="descripcionRequisito" id="descripcionRequisito"  rows="5" style="width:100%; resize: none;"></textarea>
                            <input class="col-1 m-5 btn btn-primary" type="submit" value="Agregar Requisito">
                        </div>
                    </form>
                </div>

                <!-- Documentos -->
                <div class="documentos">
                    <h1>Documentos a presentar</h1>
                    <table id="TablaDocumentos" border="1">
                        <thead>
                            <tr>
                                <th>Indice</th>
                                <th>Descripcion Documento</th>
                            </tr>
                        </thead>
                        <tbody id="bodyDocumentos">
                        </tbody>
                    </table>
                    <form id="formAddDocumentos">
                        <textarea name="descripcionDocumento" id="descripcionDocumento" cols="100" rows="10"></textarea>
                        <button type="submit" >Documento</button> 
                    </form>

                    <h2>Nota de documentacion</h2>
                    <p id="notaDocumento"></p>
                    <textarea name="notaDescripcion" id="notaDescripcion" cols="30" rows="10"></textarea>
                    <button type="button"  onclick="addNotaDocumento()">+ Nota Documentos</button>
                </div>

                <!-- Presentaciom -->
                <div class="presentacion">
                    <h1>Formas de presentacion</h1>

                    <p id="notaPresentacion"></p>
                    <textarea name="notaDescripcionPresentacion" id="notaDescripcionPresentacion" cols="30" rows="10"></textarea>
                    <button type="button"  onclick="addNotaPresentacion()">+ Nota Documentos</button>

                    <table id="TablaPresentacion" border="1">
                        <thead>
                            <tr>
                                <th>Indice</th>
                                <th>Descripcion presentacion</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <textarea name="descripcionPresentacion" id="descripcionPresentacion" cols="100" rows="10"></textarea>
                    <button type="button"  onclick="addresentacion()">+ AddPresentacion</button> 
                    
                </div>    
            
                <!--Fechas de presentacion -->
                <div class="fechaPresentacion">
                    <h1>Fecha de presentacion</h1>
                    <p id="notaFechaPresentacion"></p>
                    <textarea name="descripcionfechaPresentacion" id="descripcionfechaPresentacion" cols="30" rows="10"></textarea>
                    <button type="button"  onclick="addfechaPresentacion()">+ Nota Documentos</button>
                </div>

                <!-- Calificacion de conocimientos-->
                <div class="califConocimientos">
                    <h1>Calificacion de conocimiento</h1>
                    <p id="notaConocimientos"></p>
                    <textarea name="notaCalificacion" id="notaCalificacion" cols="30" rows="10"></textarea>
                    <button type="button"  onclick="addnotaCalifificacion()">+ Nota Calificacion</button>

                    <table id="TablaConocimeintos" border="1">
                        <thead>
                            <tr>
                                <th>Indice</th>
                                <th>Descripcion Documento</th>
                                <th>nota %</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <textarea name="descripcionConocimiento" id="descripcionConocimiento" cols="100" rows="10"></textarea>
                    <input type="text" name="txtConocimiento" id="txtConocimiento">
                    <button type="button"  onclick="addListaConocimiento()">+ Add conocimiento</button> 
                </div>

                <!-- tribunales convocatoria -->

                <div class="tribunalesConvocatoria">
                    <h1>Tribunales convocatoria</h1>
                    <p id="tribunal"></p>
                    <textarea name="descripcionTribunal" id="descripcionTribunal" cols="30" rows="10"></textarea>
                    <button type="button"  onclick="addTribunaln()">+ Nota Documentos</button>
                </div>

                <!-- fechas importantes -->
                
                <div class="FechasImportantes">
                    <h1>Fechas Importantes</h1>
                    <p id="notaFechasImportantes"></p>
                    <textarea name="dscFechasImportantes" id="dscFechasImportantes" cols="30" rows="10"></textarea>
                    <button type="button"  onclick="addFechasImportantes()">+ Fechas Importantes</button>

                    <table id="TablafechasImport" border="1">
                        <thead>
                            <tr>
                                <th>Eventos</th>
                                <th>Fechas</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <textarea name="dscEventos" id="dscEventos" cols="100" rows="10"></textarea>
                    <input type="text" name="txtFechas" id="txtFechas">
                    <button type="button"  onclick="addRowFechas()">+ Add conocimiento</button> 
                </div>

                <!-- Nombramiento --> 

                <div class="nombramiento">
                    <h1>Nombramiento</h1>
                    <p id="nombramiento"></p>
                    <textarea name="dscNombramiento" id="dscNombramiento" cols="30" rows="10"></textarea>
                    <button type="button"  onclick="addDescNombramiento()">+ Nombramientos</button>
                </div>

                <div class="row justify-content-center">
                    <input type="submit" value="Enviar" class="btn btn-primary">
                </div>
        </section>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../style/app.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

</body>
</html>