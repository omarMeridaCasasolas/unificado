$(document).ready(function () {
    //Mostrar requerimientoventanaModal
    $('#idConvocatoria').hide();
    $('#ventanaModal').hide();
    mostrarRequerimientos();
    mostrarDocumentacion();
    //Agregar requerimiento
    $("#formAgregarRequerimeinto").submit(function (e) { 
        e.preventDefault();
        let datos = {
            clase: "ConvocatoriaUnica",
            metodo: "agregarRequerimientoDocente",
            idConvocatoria: $('#idConvocatoria').val(),
            idCantidad: $('#idCantidad').val(),
            idHoras: $('#idHoras').val(),
            idDestino: $('#idDestino').val()
        } 
        $.post("../modelo/interprete.php", datos,function(resp){
            mostrarRequerimientos();
        });
    });

    function mostrarRequerimientos(){
        let datosRequerimientos = {
            clase: "ConvocatoriaUnica",
            metodo: "obtenerRequerimientosDocente",
            idConvocatoria: $('#idConvocatoria').val()
        }
        $.ajax({
            type: "POST",
            url: "../modelo/interprete.php",
            data: datosRequerimientos,
            success: function (response) {
                //console.log(response);
                let respuesta = JSON.parse(response);
                //console.log(respuesta);
                salida = "";
                respuesta.forEach(res =>{
                    salida +=`<tr id='filaRequerimiento_${res.id_requerimiento}'>
                        <td>${res.cantidad_requerimiento}</td>
                        <td>${res.cant_horas}</td>
                        <td>${res.destino_requerimiento}</td>
                        <td><button class="btn btn-danger reqDelet mx-1" id="req_${res.id_requerimiento}" type="submit">Eliminar</button><button class="btn btn-warning reqEdit mx-1" id="reqEdit_${res.id_requerimiento}" type="submit">Editar</button></td>
                    </tr>`
                });
                $("#listaRequerimientos").html(salida);
            }
        });
    }

    //Eliminar requerimiento
    $(document).on('click','.reqDelet',function (e) { 
        let tmp = this.id;
        let clave = tmp.split("_");
        console.log(clave[1]);
        let datosRequerimiento = {
            clase: "ConvocatoriaUnica",
            metodo: "eliminarRequerimiento",
            idRequerimiento: clave[1]
        }
        $.ajax({
            type: "POST",
            url: "../modelo/interprete.php",
            data: datosRequerimiento ,
            success: function (response) {
                mostrarRequerimientos();
            }
        });
        e.preventDefault();        
    });
    //editar requerimiento
    $(document).on('click','.reqEdit',function (e) { 
        let tmp = this.id;
        let clave = tmp.split("_");
        console.log(clave[1]);
        let datosRequerimiento = {
            clase: "ConvocatoriaUnica",
            metodo: "editarRequerimiento",
            idRequerimiento: clave[1]
        }
        $.ajax({
            type: "POST",
            url: "../modelo/interprete.php",
            data: datosRequerimiento ,
            success: function (response) {
                let obj = JSON.parse(response);
                //console.log(obj);
                $("#cantidadActualizar").val(obj.cantidad_requerimiento);
                $("#horasActualizar").val(obj.cant_horas);
                $("#destinoActualizar").val(obj.destino_requerimiento);
                $("#claveReqEspecifica").val(obj.id_requerimiento);
                $('#claveReqEspecifica').hide();
                $('#ventanaModal').click();
            }
        });   
    });

    $(document).on('click','#actulizarRequerimientos',function (e) { 
        let datos = {
            clase: "ConvocatoriaUnica",
            metodo: "actualizarRequerimientoDocente",
            claveReqEspecifica: $('#claveReqEspecifica').val(),
            idCantidad: $('#cantidadActualizar').val(),
            idHoras: $('#horasActualizar').val(),
            idDestino: $('#destinoActualizar').val()
        } 
        $.post("../modelo/interprete.php", datos,function(resp){
            mostrarRequerimientos();
            $('#cerrarModal').click();
        });
        e.preventDefault();
    });
    

    $("#formDocumentos").submit(function (e) { 
        e.preventDefault();
        console.log("Hizo click")
        let datos = {
            clase: "ConvocatoriaUnica",
            metodo: "agregarDocumentacion",
            idConvocatoria: $('#idConvocatoria').val(),
            documento: $('#iDdocument').val()
        };
        $.ajax({
            type: "POST",
            url: "../modelo/interprete.php",
            data: datos ,
            success: function (response) {
                console.log(response);
                mostrarDocumentacion();
            }
        });
    });

    function mostrarDocumentacion(){
        let datosDocumentacion = {
            clase: "ConvocatoriaUnica",
            metodo: "obtenerDocumentacion",
            idConvocatoria: $('#idConvocatoria').val()
        }
        $.ajax({
            type: "POST",
            url: "../modelo/interprete.php",
            data: datosDocumentacion,
            success: function (response) {
                //console.log(response);
                let respuesta = JSON.parse(response);
                //console.log(respuesta);
                salida = "";
                respuesta.forEach(res =>{
                    salida +=`<tr id='filaDocumentos_${res.id_documentos}'>
                        <td>${res.descripcion_documento}</td>
                        <td><div class='text-center'><button class="btn btn-danger reqDoc mx-1" id="doc_${res.id_documentos}" type="submit">Eliminar</button><button class="btn btn-warning docEdit mx-1" id="docEdit_${res.id_documentos}" type="submit">Editar</button></div></td>
                    </tr>`
                });
                $("#listaDocumentos").html(salida);
                //console.log(salida);
            }
        });
    }
    
});
