<?php
    session_start();
    $clavePrimaria = $_SESSION['claveConvocatoria'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluaciones de la convocatoria</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <main class="container">
    <h2>Evaluaciones</h2>
        <form>
            <h4>Evaluacion de meritos</h4>
            <div class="row">
                <div class="col-8"><textarea name="textEvaluacionMerito" id="textEvaluacionMerito" class="w-100 form-control" rows="5" required></textarea></div>
                <div class="form-group col-4">
                    <label for="calidMerito">Ingrese el porcentaje(%) de la evaluacion de meritos sobre la nota final</label>
                    <input type="text" name="calidMerito" id="calidMerito" class="form-control w-25">
                </div>
                <table class="table table-hover mt-3" id="tablaMeritos">
                    <thead>
                        <th>Descripcion de merito</th>
                        <th>Porcentaje</th>
                        <th>Opciones</th>                        
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </form>
        <form>

        </form>
        
    </main>
</body>
</html>