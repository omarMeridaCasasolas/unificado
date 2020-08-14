<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convocatoria Personalizada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <main class='container'>
    <form action="../formularios/form_CrearConvocatoria.php" method="post">
        <h1 class="text-center">Crear Convocatoria</h1>
        <div class="form-group text-center">
            <div class="text-left"><h5>Titulo de la convocatoria</h5></div>
            <textarea name="idTitulo" id="idTitulo" class='mx-4 mb-4' rows="4" style="width:98%;" required></textarea>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-grup">
                    <label for="gestionConvocatoria">Selecione Gestion</label>
                    <select id="gestionConvocatoria" name="gestionConvocatoria" class='form-control' required>
                        <?php
                            date_default_timezone_set('America/La_Paz');
                            $mes=date('m');
                            $year=date('Y');
                            if($mes<6){
                                $aux1="Gestion I-".$year;
                                $aux2="Gestion II-".$year;
                                echo "<option value='gestion general'>General</option>
                                    <option value='$aux1'>$aux1</option>
                                    <option value='$aux1'>$aux12</option>";
                            }else{
                                $year_actual = date("Y");
                                $yearProx=date("Y",strtotime($fecha_actual."+ 1 year"));
                                $aux1="Gestion II-".$year;
                                $aux2="Gestion I-".$yearProx;
                                echo "<option value='gestion general'>General</option>
                                    <option value='$aux1'>$aux1</option>
                                    <option value='$aux2'>$aux2</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="tipoConvocatoria">Tipo de convocatoria</label>
                        <select name="tipoConvocatoria" id="tipoConvocatoria" class='form-control'required>
                            <option value="Tipo general">En general</option>
                            <option value="Auxiliar de docencia">Auxiliar de docencia</option> 
                            <option value="Auxiliar de laboratorio">Auxiliar de laboratorio</option>   
                        </select>          
                </div>
            </div>
            <div class="col-6">
                <div class="form-grup">
                    <label for="departamentoConvocatoria">Seleccione departamento</label>
                    <select id="departamentoConvocatoria" name="departamentoConvocatoria" class='form-control' required>
                            <option value="Departamentos en general">General</option>
                            <option value="Departamento De Biologia">Departamento De Biologia</option>
                            <option value="Departamento de Ingeniería Eléctrica y Electrónica">Departamento de Ingeniería Eléctrica y Electrónica</option>
                            <option value="Departamento de Química">Departamento de Química</option>
                            <option value="Convocatoria de fisica">Departamento De Fisica</option>
                            <option value="Departamento de Sistemas/Informatica">Departamento de Sistemas/Informatica</option>
                            <option value="Departamento de Industrias">Departamento de Industrias</option>
                            <option value="Departamento de Ingeniería mecánica – electromecánica (DIME)">Departamento de Ingeniería mecánica – electromecánica (DIME)</option>
                            <option value="Departamento de Matemáticas">Departamento de Matemáticas</option>
                            <option value="Departamento de Ingeniería Civil">Departamento de Ingeniería Civil</option>
                    </select>
                </div>            
            </div>
        </div>

        <div class="text-center my-4">
            <div class="text-left"><h5>Descripcion de la convocatoria</h5></div>
            <textarea name="descripcionConvocatoria" id="descripcionConvocatoria" class='mx-4 mb-4' rows="4" style="width:98%;" required></textarea>
        </div>

        <div class="text-center">
            <input type="submit" value="Crear Convocatoria" class='btn btn-primary'>
        </div>
    </form>
        <div class="text-center d-block mx-auto">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>               
        </div>
    </main>
</body>
</html>