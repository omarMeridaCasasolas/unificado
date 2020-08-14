$(document).ready(function () {
    $("#idConvocatoria").hide();
    $("#ventanaModal").hide();
    mostrarDetallesConvocatoria();
    var formaPresentacion;
    function mostrarDetallesConvocatoria(){
        let datos = {
            clase: "ConvocatoriaUnica",
            metodo: "detallesConvocatoria",
            idConvocatoria: $('#idConvocatoria').val()
        }
        $.ajax({
            type: "POST",
            url: "../modelo/interprete.php",
            data: datos,
            success: function (response) {
                let respuesta = JSON.parse(response);
                //let myButtonEdit= "<button id='editFormas' class='btn btn-warning m-1'>Editar</button>";
                formaPresentacion = respuesta.forma_presentacion;
                fechaPresentacion = respuesta.fecha_presentacion;
                $('#parrafoformaPresentacion').html(respuesta.forma_presentacion);
                $('#fechaPresentacion').html(respuesta.fecha_presentacion);
                //$("#divBotones").append(myButtonEdit);
                //console.log(formaPresentacion);
            }
        });
    }

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

    $("#editFormas").click(function (e) { 
        $("#areaPresentacion").val(formaPresentacion);
        $('#ventanaModal').click();
    });

    $("#formActualizarPresentacion").submit(function (e) { 
        let datos = {
            clase: "ConvocatoriaUnica",
            metodo: "actualizarDocumentos",
            formaPresentacion: $('#areaPresentacion').val(),
            idConvocatoria: $('#idConvocatoria').val()
        }
        $.post("../modelo/interprete.php", datos,function(resp){
            console.log(resp);
            $('#cerrarModal').click();
            mostrarDetallesConvocatoria();
        });
        e.preventDefault();
    });
});