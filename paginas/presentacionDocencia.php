<?php
    session_start();
    if(isset($_SESSION['claveConvocatoria'])){
        $clavePrimaria = $_SESSION['claveConvocatoria'];
        require_once('../modelo/convocatoriaUnica.php');
        $convocatoria = new ConvocatoriaUnica();
        $respuesta = $convocatoria ->obtenerPresentacion($_SESSION['claveConvocatoria']);
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
        <form action="../formularios/form_presentacion.php" method="post">
            <input type="text" id="idConvocatoria" value="<?php echo $_SESSION['claveConvocatoria']; ?>">
            <h2>4.FECHA Y LUGAR DE PRESENTACIÓN DE DOCUMENTOS </h2>
            <h3>4.1 DE LA FORMA </h3>
            <textarea name="idFormaPresentacion" id="idFormaPresentacion" class="w-100" rows="5"><?php echo $respuesta['forma_presentacion']; ?></textarea>
            <h3>4.2 FECHA DE PRESENTACIÓN</h3>
            <textarea name="idFechaPresentacion" id="idFechaPresentacion" class="w-100" rows="5"><?php echo $respuesta['fecha_presentacion']; ?></textarea>
            <div class="text-center m-4">
            <input type="submit" class='btn btn-primary' value="Actualizar Presentacion">
            <a href="evaluaciones_de_la_convocatoria.php" class='btn btn-info'>Evaluaciones</a>
            </div>
        </form>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="presentacionConvocatoria.js"></script>
</body>
</html>