<?php
    require_once('convocatoria.php');
    require_once('Departamento.php');
    require_once('evaluadores.php');
    require_once('postulante.php');
    require_once('evaluacion.php');
    require_once('convocatoriaUnica.php');
    $clase ="";
    $metodo = "";
    $tmp =" ";
    if(isset($_REQUEST['clase']) && isset($_REQUEST['metodo'])){
        $clase = $_REQUEST['clase'];
        $metodo = $_REQUEST['metodo'];
        switch($clase){
            case 'Departamento':
                $tmp = ejecutarConsultaDepartamentos();
                break;
            case 'Convocatoria':
                $tmp = ejecutarConsultaConvocatoria();
                break;
            case 'Evaluadores':
                $tmp = ejecutarConsultaEvaluadores();
                break;
            case 'Postulante':
                $tmp = ejecutarConsultasPostulantes();
                break;
            case 'Calificaciones':
                $tmp = ejecutarConsultasCalificaciones();
                break;
            case 'ConvocatoriaUnica':
                $tmp = ejecutarConvocatoriaUnica();
                break;
            default:
                break;
        }
        echo $tmp;
    }
    function ejecutarConvocatoriaUnica(){
        $convocatoria = new ConvocatoriaUnica();
        $metodo = $_REQUEST['metodo'];
        switch ($metodo) {
            case 'obtenerRequerimientosDocente':
                $idConvocatoria = $_REQUEST['idConvocatoria'];
                $res = $convocatoria->obtenerRequerimientosDocente($idConvocatoria);
                break;
            case 'eliminarRequerimiento':
                $idRequerimiento = $_REQUEST['idRequerimiento'];
                $res = $convocatoria->eliminarRequerimiento($idRequerimiento);
                break;
            case 'editarRequerimiento':
                $idRequerimiento = $_REQUEST['idRequerimiento'];
                $res = $convocatoria->editarRequerimiento($idRequerimiento);
                break;
            case 'agregarRequerimientoDocente': 
                $idConvocatoria = $_REQUEST['idConvocatoria'];
                $idCantidad = $_REQUEST['idCantidad'];
                $idHoras = $_REQUEST['idHoras'];
                $idDestino = $_REQUEST['idDestino'];
                $res = $convocatoria->agregarRequerimientoDocente($idConvocatoria,$idCantidad,$idHoras,$idDestino);
                break;
            case 'actualizarRequerimientoDocente': 
                $claveReqEspecifica = $_REQUEST['claveReqEspecifica'];
                $idCantidad = $_REQUEST['idCantidad'];
                $idHoras = $_REQUEST['idHoras'];
                $idDestino = $_REQUEST['idDestino'];
                $res = $convocatoria->actualizarRequerimientoDocente($claveReqEspecifica,$idCantidad,$idHoras,$idDestino);
                break; 
            case 'agregarDocumentacion':
                $idConvocatoria = $_REQUEST['idConvocatoria'];
                $documento = $_REQUEST['documento'];
                $res = $convocatoria->agregarDocumentacion($idConvocatoria,$documento);
                break;
            case 'obtenerDocumentacion':
                $idConvocatoria = $_REQUEST['idConvocatoria'];
                $res = $convocatoria->obtenerDocumentacion($idConvocatoria);
                break;
            //forma Presentacion    
            case 'agregarFormaPresentacion':
                $idConvocatoria = $_REQUEST['idConvocatoria'];
                $idFormaPresentacion = $_REQUEST['idFormaPresentacion'];
                $res = $convocatoria->agregarFormaPresentacion($idConvocatoria,$idFormaPresentacion);
                break;
            case 'detallesConvocatoria':
                $idConvocatoria = $_REQUEST['idConvocatoria'];
                $res = $convocatoria->detallesConvocatoria($idConvocatoria);
                break;
            case 'actualizarDocumentos':
                $idConvocatoria = $_REQUEST['idConvocatoria'];
                $formaPresentacion = $_REQUEST['formaPresentacion'];
                $res = $convocatoria->actualizarDocumentos($idConvocatoria,$formaPresentacion);
                break;
            default:
                # code...
                break;
        }
        return $res;
    }

    function ejecutarConsultasCalificaciones(){
        $evaluacion = new Evaluacion();
        $metodo = $_REQUEST['metodo'];
        switch ($metodo) {
            case 'obtenerPruebas':
                $idConvocatoria = $_REQUEST['idConvocatoria'];
                $res = $evaluacion->obtenerTitulosPruebas($idConvocatoria);
                break;
            case 'obtenerReglas':
                $idMerito= $_REQUEST['idMerito'];
                $res = $evaluacion->obtenerReglas($idMerito);
                break;
            case 'obtenerNormas':
                $idRegla = $_REQUEST['idRegla'];
                $res = $evaluacion->obtenerNormas($idRegla);
                break;
            default:
                # code...
                break;
        }
        return $res;
    }

    function ejecutarConsultasPostulantes(){
        $postulante = new Postulante();
        $metodo = $_REQUEST['metodo'];
        switch ($metodo){
            case 'obtenerPostulanteEspecifico':
                $clave = $_REQUEST['clave'];
                $idMateria = $_REQUEST['idMateria'];
                $res = $postulante -> obtenerPostulanteEspecifico($clave,$idMateria);
                break;
            case 'actualizarDocumentosPostulante':
                $clave = $_REQUEST['clave'];
                $idMateria = $_REQUEST['idMateria'];
                $cantDocumentosPos = $_REQUEST['cantDocumentosPos'];
                $observacionesPos = $_REQUEST['observacionesPos'];
                $horaDeEntrega = $_REQUEST['horaDeEntrega'];
                $res = $postulante -> actualizarDocumentosPostulante($clave,$idMateria,$cantDocumentosPos,$observacionesPos,$horaDeEntrega);
                break;
            default:
                # code...
                break;
        }
        return $res;
    }

    function ejecutarConsultaEvaluadores(){
        $evaluador = new Evaluador();
        $metodo = $_REQUEST['metodo'];
        switch ($metodo) {
            case 'listaEvaluadores':
                $tipo =$_REQUEST['tipo'];
                $idMateria = $_REQUEST['idMateria'];
                $res = $evaluador->getListaEvaluadores($idMateria,$tipo); 
                break;
            case 'addEvaluadores':
                $tipo =$_REQUEST['tipo'];
                $idMateria = $_REQUEST['idMateria'];
                $idName = $_REQUEST['idName'];
                $idCi = $_REQUEST['idCi'];
                $idCorreo = $_REQUEST['idCorreo'];
                $idTelefono = $_REQUEST['idTelefono'];
                $idCargo = $_REQUEST['idCargo'];
                $idDepartamento = $_REQUEST['idDepartamento'];
                $idPass = $_REQUEST['idPass']; 
                $aux = $evaluador->addEvaluadores($idMateria,$tipo,$idName,$idCi,$idCorreo,$idTelefono,$idCargo,$idDepartamento,$idPass); 
                if($aux){
                    $clavePrimaria = $evaluador->getClavePrimariaEvaluador($idName,$idCi); 
                    $x = $clavePrimaria[0]["id_evaluador"];
                    //echo var_dump($x);
                    $res = $evaluador->subirMateriaEvaluador($idMateria,$x);
                }else{
                    $res = "No tienen clave primaria";
                }
                break;
            case 'eliminarEvaluador':
                $clave =$_REQUEST['clave'];
                $idMateria = $_REQUEST['idMateria'];
                $res = $evaluador->EliminarEvaluador($clave,$idMateria); 
                break;
            case 'obtenerEvaluadorEspecifico':
                $clave =$_REQUEST['clave'];
                $res = $evaluador->obtenerEvaluadorEspecifico($clave); 
                break;
            case 'actualizarEvaluadorEspecifico':
                //echo var_dump("paso por aqui");
                $clave =$_REQUEST['clave'];
                $idName = $_REQUEST['idName'];
                $idCi = $_REQUEST['idCi'];
                $idCorreo = $_REQUEST['idCorreo'];
                $idTelefono = $_REQUEST['idTelefono'];
                $idCargo = $_REQUEST['idCargo'];
                $idDepartamento = $_REQUEST['idDepartamento'];
                $res = $evaluador->actualizarEvaluadorEspecifico($clave,$idName,$idCi,$idCorreo,$idTelefono,$idCargo,$idDepartamento);
                break;
            case 'listaEvaluadoresObtenidos':
                $busqueda =$_REQUEST['busqueda'];
                $res = $evaluador->listaEvaluadoresObtenidos($busqueda); 
                break;
            case 'agregarEvaluadorConvocatoria':
                $idMateria = $_REQUEST['idMateria'];
                $clave = $_REQUEST['clave'];
                $res = $evaluador->subirMateriaEvaluador($idMateria,$clave); 
                break;
            default:
                # code...
                break;
        }
        return $res;
    }


    function ejecutarConsultaDepartamentos(){
        $departamento = new Departamento();
        $metodo = $_REQUEST['metodo'];
        switch ($metodo) {
            case 'getDepartamentos':
                $res = $departamento->getDepartamentos(); 
                break;
            default:
                # code...
                break;
        }
        return $res;
    }
    function ejecutarConsultaConvocatoria(){
        $convocatoria = new Convocatoria();
        $metodo = $_REQUEST['metodo'];
        switch ($metodo) {
            case 'addTituloGestion':
                $cPrimary = $_REQUEST['cPrimary'];
                $fechaDeCreacion = $_REQUEST['fechaDeCreacion'];
                $usuarioDev = $_REQUEST['usuarioDev'];
                $titulo = $_REQUEST['titulo'];
                $gestion = $_REQUEST['gestion'];
                $departamento = $_REQUEST['departamento'];
                $descripcion = $_REQUEST['descripcion'];
                $resp = $convocatoria->addTituloGestion($titulo,$gestion,$cPrimary,$fechaDeCreacion,$usuarioDev,$departamento,$descripcion);
                break;
            case 'getRequerimientos':
                $identificar = $_REQUEST['identificar'];
                $resp = $convocatoria->getRequerimientos($identificar);
                break;
            case 'addRequerimiento':
                $identificador = $_REQUEST['identificador'];
                $itemsConvocatoria = $_REQUEST['itemsConvocatoria'];
                $cantRequermiento = $_REQUEST['cantRequermiento'];
                $horasAcademicas = $_REQUEST['horasAcademicas'];
                $nombreAuxiliatura = $_REQUEST['nombreAuxiliatura'];
                $codigoAuxiliatura = $_REQUEST['codigoAuxiliatura'];
                $resp = $convocatoria->addRequerimientos($identificador,$itemsConvocatoria,$cantRequermiento,$horasAcademicas,$nombreAuxiliatura,$codigoAuxiliatura);              
                break;

            case 'addRequisito':
                $claveP = $_REQUEST['claveP'];
                $indice = $_REQUEST['indice'];
                $descripcionRequisito = $_REQUEST['descripcionRequisito'];
                $resp = $convocatoria->addRequisito($claveP,$indice,$descripcionRequisito);
                break;
            case 'eliminarRequerimiento':
                $id = $_REQUEST['id'];
                $resp = $convocatoria->eliminarRequerimiento($id);
                break;     
            case 'getRequisitos':
                $id = $_REQUEST['identificar'];
                $resp = $convocatoria->getRequisitos($id);
                break;
            case 'eliminarRequisito':
                $id = $_REQUEST['id'];
                $resp = $convocatoria->eliminarRequisito($id);
                break; 
            case 'actualizarRequisito': 
                $claveP = $_REQUEST['claveP'];   
                $id = $_REQUEST['indice'];
                $descripcionRequisito = $_REQUEST['descripcionRequisito'];
                $resp = $convocatoria->actualizarRequisito($claveP,$id,$descripcionRequisito);
                break; 

            case 'addDocumento':
                $claveP = $_REQUEST['claveP'];
                $indice = $_REQUEST['indice'];
                $descripcionDocumento = $_REQUEST['descripcionDocumento'];
                $resp = $convocatoria->addDocumento($claveP,$indice,$descripcionDocumento);
                break;
            case 'mostrarDocumentos':
                $id = $_REQUEST['identificar'];
                $resp = $convocatoria->mostrarDocumentos($id);
                break;
            default:
                # code...
                break;
        }
        return $resp;
    }
?>