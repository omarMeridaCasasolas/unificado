<?php
if(isset($_GET['idPost']) && isset($_GET['idMat'])){
    session_start();
    $myArray = array();
    $idPostulante = $_GET['idPost'];
    $idMateria = $_GET['idMat'];
    $idConvocatoria = $_GET['idConv'];
    require_once('../modelo/evaluacion.php');
    $evaluacion = new Evaluacion();
}else{
    echo "Error al recibir los parametros";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluar conocimiento y meritos</title>
    <link rel="stylesheet" href="../style/bootstrap.css">
    <link rel="stylesheet" href="../style/myStyle.css">
</head>
<body class='p-2'>
    <?php $notaConvocatoria = $evaluacion->obtenerConvocatoria($idConvocatoria);
        echo "<h2>Evaluacion de meritos y conocimientos</h2>";
        $notaTotalMerito = $notaConvocatoria['porcentaje_merito'];
        $notaTotalConocimiento = $notaConvocatoria['porcentaje_conocimiento'];
        echo "<h4>La nota recibida en la evaluacion del merito equivale a <strong id='notaTotalMerito'>".$notaTotalMerito."</strong></h4>";
        echo "<h4>La nota recibida en la evaluacion del merito equivale a <strong id='notaTotalConococimeinto'>".$notaTotalConocimiento."</strong></h4>";

    ?>
    <h2>Evaluacion de meritos</h2>
    <form action="../formularios/formEvaluacionPostulante.php" method='POST'>
        <input type="text" name="id_postulante" id="id_postulante" value="<?php echo $idPostulante;?>">
        <input type="text" name="id_materia" id="id_materia" value="<?php echo $idMateria;?>">
        <input type="text" name="id_convocatoria" id="id_convocatoria" value="<?php echo $idConvocatoria;?>">
        <section class='p-4'>
            <ol class='list-group-flush'>
            <?php
                $evaluacionMeritos = $evaluacion->obtenerTitulosPruebas($idConvocatoria);
                foreach($evaluacionMeritos as $meritoGeneral){
                    $auxMerito = "tmpAux_".$meritoGeneral['id_merito'];
                    echo "<li class='p-1'>".$meritoGeneral['titulo_merito']."                          <span>".$meritoGeneral['porcentaje_merito']."</span>";  

                    $evaluacionReglas = $evaluacion->obtenerReglas($meritoGeneral['id_merito']);
                    echo "<ol type='A'>";
                    foreach($evaluacionReglas as $regla){

                        echo "<li class='pl-3'>".$regla['titulo_regla']."                <span>".$regla['porcentaje_regla']."</span>";
                        $evaluacionNormas = $evaluacion->obtenerNormas($regla['id_regla']);
                        if(empty($evaluacionNormas)){
                            $idNameRegla =$meritoGeneral['id_merito']."_idNota_".$regla['id_regla'];

                            echo "<label for='' class='ml-5'>Escriba la nota --------> <input type='text' name='idNota_".$regla['id_regla']."' class='subtitulos' id='idNota_".$regla['id_regla']."' value='0' numMax='".$regla['porcentaje_regla']."' pattern='[0-9]{1,2}'></label>";
                            echo "<span id='msg_".$regla['id_regla']."' class='text-danger'></span>";
                        }
                        echo "<ol type='a'>";
                        foreach($evaluacionNormas as $norma){
                            //echo var_dump($norma);
                            echo "<li class='pl-3'>".$norma['descripcion_norma']."                <span>".$norma['puntos_norma']."</span></li>";
                            if($evaluacionNormas){
                                $tmpNorma = $regla['id_regla']."_put_".$norma['id_norma'];
                                //echo "<label> Maxima Nota :<input type='text' id='regla_".$regla['id_regla']."' value='".$regla['porcentaje_regla']."'> </label>";
                                echo "<label for='' class='ml-5'>Escriba la cantidad --------> <input type='search' valorN='".$norma['puntos_norma']."' class='normas' id='idNorma_".$norma['id_norma']."' name='idNorma_".$norma['id_norma']."' value='0' pattern='[0-9]{1,2}'></label>";
                                echo "<label>    puntaje obtenido :<input type='text' class='putClass' id='put_".$norma['id_norma']."' value='0'></label>";
                                echo "<span id='msgNorma_".$norma['puntos_norma']."' class='text-danger'></span>";
                            }
                        }
                        
                        echo "</ol></li>";
                    }
                    echo "<h5>El total obtenido es <input type='text' name='reglaF_".$regla['id_regla']."' id='reglaF_".$regla['id_regla']."' value='0'></h5> ";
                    echo "</ol></li><hr>";

                }
            ?>
            </ol> 
            <strong>Puntaje obtenido en la evaluacion de meritos <input type="text" name="puntajeMeritos" id="puntajeMeritos" value='0'> sobre/100</strong>
            <br>
            <strong>Puntaje total sobre la convocatoria <input type="text" name="notaMeritoFinal" id="notaMeritoFinal" value='0'>sobre/<?php echo $notaTotalMerito; ?></strong>
        </section> 
        <section>
            <br>
            <h4>Evaluacion de Conocimiento</h4>
                </ol class='list-group-flush'>
                <?php 
                    $listaDeConocimientos = $evaluacion->evaluacionDeConocimiento($idConvocatoria);
                    foreach($listaDeConocimientos as $conocimiento){
                        echo "<li class='pl-3'>".$conocimiento['descripcion_conocimiento']." <strong id='str".$conocimiento['id_conocimientos']."'> ".$conocimiento['nota_conocimiento']."</strong></li>";
                        echo "<label>Nota obtenida<input type='text' class='putConocimiento ml-5' id='idCon_".$conocimiento['id_conocimientos']."' name='idCon_".$conocimiento['id_conocimientos']."' value='0'> /100 = </label>";
                        echo "<input type='text' name='idNotaC_".$conocimiento['id_conocimientos']."' id='idNotaC_".$conocimiento['id_conocimientos']."' class='inputConocimiento' value='0'>";
                        //$myArray["idNotaC_".$conocimiento['id_conocimientos']] = $conocimiento['descripcion_conocimiento']; 
                    }
                ?>
                </ol>
                <label for="finalEConocimiento">El valor total de conocimiento es:</label>
                <input type="text" name="finalEConocimiento" id="finalEConocimiento" value="0">
        </section> 
        
        <label for="" class='text-center text-primary'> El valor final entre conocimiento y meritos es: <input type="text" name="notaTotalCM" id="notaTotalCM" value='0'></label>
                        <div class="text-center">
                        <?php  $_SESSION['arreglo'] = $myArray; ?>
                        <input type="submit"  class='btn btn-primary' value="Terminar evaluacion">
                        </div>
                    
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            //conocimeinto 
            $('.putConocimiento').blur(function (e) { 
                let tmp = this.id;
                let clavePrimaria = tmp.split('_');
                let puntaje = parseInt($("#idCon_"+clavePrimaria[1]).val());   
                console.log(clavePrimaria);
                if(limitesNumero(puntaje,100)){
                    let res = parseInt($('#str'+clavePrimaria[1]).html());
                    console.log(res);
                    let resultado = puntaje * (res/100);
                    $("#idNotaC_"+clavePrimaria[1]).val(resultado);
                    obtenerTotalConocimiento();
                }
                e.preventDefault(); 
            });

            function entregarNotaFinal(){
                let notaFinalMerito = parseInt($('#finalEConocimiento').val());
                let notaFinalConocimiento = parseInt($('#notaMeritoFinal').val());
                $('#notaTotalCM').val(notaFinalMerito+notaFinalConocimiento);
            }

            var totalConocimientos = 0;
            function obtenerTotalConocimiento(){
                if(totalConocimientos != 0){
                    totalConocimientos = 0;
                }
                $(".inputConocimiento").each(function(){
                    totalConocimientos  += parseInt($(this).val());
                });
                let variable = parseInt($('#notaTotalConococimeinto').html());
                let res2 = totalConocimientos * ( variable /100);
                if(isNaN(res2)){
                    $('#finalEConocimiento').val(0);
                }else{
                    $('#finalEConocimiento').val(res2);
                }
                entregarNotaFinal();
            }

            //Subtitulos
            $('.subtitulos').blur(function (e) { 
                let tmp = this.id;
                let clavePrimaria = tmp.split('_');
                let puntaje = $("#idNota_"+clavePrimaria[1]).val();
                let maximo = $("#idNota_"+clavePrimaria[1]).attr('numMax');
                if(!isNaN(puntaje)){
                    if(limitesNumero(puntaje,maximo)){
                        $("#msg_"+clavePrimaria[1]).html("");
                        sumarPuntajeMeritos();
                    }else{
                        $("#msg_"+clavePrimaria[1]).html("el numero debe oscilar entre 0 y "+maximo);
                        console.log("problem1");
                    }
                }else{
                    $("#msg_"+clavePrimaria[1]).html("Solo se permite numeros");
                    console.log("problem2");
                }
            });
            
            
            
            //Normas
            $('.normas').blur(function (e) { 
                let tmp = this.id;
                let clavePrimaria = tmp.split('_');
                let puntaje = $("#idNorma_"+clavePrimaria[1]).val();
                let valorDeLaNorma = $("#idNorma_"+clavePrimaria[1]).attr('valorN');
                let maximo = 10;
                if(!isNaN(puntaje)){
                    if(limitesNumero(puntaje,maximo)){
                        $("#msgNorma_"+clavePrimaria[1]).html("");
                        let res = puntaje * valorDeLaNorma;
                        $('#put_'+clavePrimaria[1]).val(res);
                        sumarPuntajeMeritos();
                    }else{
                        $("#msgNorma_"+clavePrimaria[1]).html("el numero debe oscilar entre 0 y "+maximo);
                        console.log("problem1");
                    }
                }else{
                    $("#msg_"+clavePrimaria[1]).html("Solo se permite numeros");
                    console.log("problem2");
                }
            });

            var total = 0;
            var subtotal = 0;
            function sumarPuntajeMeritos(){
                if(total != 0 || subtotal !=0){
                    total = 0; 
                    subtotal = 0;
                } 
                $(".subtitulos").each(function(){
                    total += parseInt($(this).val());
                });
                $(".putClass").each(function(){
                    total += parseInt($(this).val());
                });

                console.log(total);
                $('#puntajeMeritos').val(total);
                let num = parseInt($('#notaTotalMerito').html());
                totalFinal = total * (num / 100);
                $('#notaMeritoFinal').val(totalFinal);
                entregarNotaFinal();
            }

            function limitesNumero(valor,limiSuperior){
                if(valor>=0 && valor<=limiSuperior){
                    return true;
                }
                return false;
            }

            $('.normas').keyup(function (e) { 
                let tmp = this.id;
                let clavePrimaria = tmp.split('_');
                console.log(clavePrimaria[1]);
                let puntaje = $("#idNota_"+clavePrimaria[1]).val();
                console.log(puntaje);
            });
        });
    </script>
</body>
</html>