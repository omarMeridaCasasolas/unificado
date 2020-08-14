<?php
    require_once("conexion.php");
    class Convocatoria extends Connexion{
        public function Convocatoria(){
            parent::__construct();
        }
        public function cerrarConexion(){
            $this->connexion_bd=null;
        }
        /*
        public function mostrarConvocatoriaUnicaX($id){
            $sql="SELECT * FROM convocatoria WHERE id_convocatoria= :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$id));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado;
        }
        */
        public function mostrarListaDeDocumentos($id){
            $sql="SELECT * FROM documentos WHERE id_convocatoria= :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$id));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado;
        }

        public function mostrarMateriaCompleta($id_requerimiento){
            $sql="SELECT * FROM requerimientos WHERE id_requerimiento= :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$id_requerimiento));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado;
        }
        public function mostrarConvocatoriaUnica($id){
            $sql="SELECT * FROM convocatoria WHERE id_convocatoria= :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$id));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado[0];
        }
        
        public function mostrarConvocatoriaCompleta($id){
            $sql="SELECT * FROM convocatoria WHERE id_convocatoria= :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$id));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado;
        }
        public function mostrarConvocatoriaFechaDescendente(){
            $sql="SELECT * FROM convocatoria WHERE visible='true' ORDER BY fecha_subida desc";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute();
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado;
        }
        public function mostrarMateriasDisponibles($id){
            $sql="SELECT * FROM requerimientos WHERE id_convocatoria = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$id));
            $resultado = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado;
        }

        public function materiaInscrita($id_post,$id_req){
            $sql="SELECT * FROM postulante_requerimiento WHERE id_requerimiento = :id_req AND id_postulante = :id_post";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id_req"=>$id_req,":id_post"=>$id_post));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            if($resultado){
                return $resultado[0];
            }else{
                return 0;
            }
        }

        public function inscribirPostulanteMateria($id_post,$id_req){
            $sql="INSERT INTO postulante_requerimiento(id_requerimiento,id_postulante) VALUES(:id_req,:id_post)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id_req"=>$id_req,":id_post"=>$id_post));
            $sentenceSQL->closeCursor();
            return $resultado;
        }
        public function eliminarPostulanteMateria($id_post,$id_req){
            $sql="DELETE FROM postulante_requerimiento WHERE id_requerimiento= :id_req AND id_postulante =:id_post";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id_req"=>$id_req,":id_post"=>$id_post));
            $sentenceSQL->closeCursor();
            return $resultado;
        }
        public function mostrarSoloMateriasInscritas($idPostulante){
            $sql = "SELECT * FROM requerimientos WHERE id_requerimiento IN (SELECT id_requerimiento WHERE id_postulante = :id_post)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id_post"=>$idPostulante));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado[0];
        }
        public function mostrarRequerimientoPostulante($id_conv,$id_post){
            $sql = "SELECT * FROM requerimientos WHERE id_convocatoria = :id_conv AND id_requerimiento IN (SELECT id_requerimiento FROM postulante_requerimiento WHERE id_postulante = :id_post)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id_conv"=>$id_conv,":id_post"=>$id_post));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado;
        }
        

        public function eliminarConvocatoria($id){
            $sql="UPDATE convocatoria SET activo=false WHERE id_convocatoria= :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$id));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado;
        }
        public function addTituloGestion($titulo,$gestion,$cPrimary,$fechaDeCreacion,$usuarioDev,$departamento,$descripcion){
            $sql = "INSERT INTO convocatoria(id_convocatoria,nombre_convocatoria,gestion_convocatoria,fecha,autor_convocatoria,departamento,descripcion_conv) 
                    VALUES (:claveP,:tit,:gest,:fecha,:autor_conv,:depar,:des_conv)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":claveP"=>$cPrimary,":tit"=>$titulo,":gest"=>$gestion,":fecha"=>$fechaDeCreacion,":autor_conv"=>$usuarioDev,":depar"=>$departamento,":des_conv"=>$descripcion));
            $sentenceSQL -> closeCursor();
            return $resultado; 
        } 

        public function addRequerimientos($identificador,$itemsConvocatoria,$cantRequermiento,$horasAcademicas,$nombreAuxiliatura,$codigoAuxiliatura){
            $sql = "INSERT INTO requerimientos(id_convocatoria,items_requerimiento,cantidad_requerimiento,can_horas,destino_requerimiento) VALUES (:id,:item,:cant,:hAcad,:dest)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$identificador,":item"=>$itemsConvocatoria,":cant"=>$cantRequermiento,":hAcad"=>$horasAcademicas,":dest"=>$nombreAuxiliatura));
            $sentenceSQL -> closeCursor();
            return $resultado; 
        }
        //mostrar reuerimientos
        public function getRequerimientos($identificador){
            $sql = "SELECT * from requerimientos where id_convocatoria=:id order by items_requerimiento";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$identificador));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }
        //add Requisito
        public function addRequisito($claveP,$indice,$descripcionRequisito){
            $sql = "INSERT INTO requisitos(id_convocatoria,descripcion_requisito,indice_req) VALUES(:keyF,:desRequisito,:ind)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":keyF"=>$claveP,":desRequisito"=>$descripcionRequisito,":ind"=>$indice));
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        //show requisitos
        public function getRequisitos($identificador){
            $sql = "SELECT * from requisitos where id_convocatoria=:id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$identificador));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }
        //eliminar requesito
        public function eliminarRequisito($id){
            $sql = "DELETE FROM requisitos WHERE id_requisitos = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$id));
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        //Actualizar requisitos
        public function actualizarRequisito($claveP,$id,$descripcionRequisito){
            $sql= "UPDATE requisitos set descripcion_requisito = :descripcionRequisito,indice_req = :id WHERE id_requisitos= :claveP";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado=$sentenceSQL->execute(array(":descripcionRequisito"=>$descripcionRequisito,":id"=>$id,":claveP"=>$claveP));
            $sentenceSQL->closeCursor();
            return $resultado;

        }
        //eliminar requerimiento
        public function eliminarRequerimiento($id){
            $sql = "DELETE FROM requerimientos WHERE id_requerimiento = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$id));
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        //add Documentos
        public function addDocumento($claveP,$indice,$descripcionDocumento){
            $sql = "INSERT INTO documentos(id_convocatoria,descripcion_documento,indice_doc) VALUES(:keyF,:desDoc,:ind)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":keyF"=>$claveP,":desDoc"=>$descripcionDocumento,":ind"=>$indice));
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        //mostrar documentos
        public function mostrarDocumentos($identificador){
            $sql = "SELECT * from documentos where id_convocatoria=:id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$identificador));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }
        //mostrar lista de presentaciones
        public function mostrarPresentaciones($identificador){
            $sql = "SELECT * from presentacion where id_convocatoria=:id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$identificador));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }
        //mostrar lista de conocimientos
        public function mostrarConocimientos($identificador){
            $sql = "SELECT * FROM conocimientos WHERE id_convocatoria=:id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$identificador));
            $resultado = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }
        //Mostrar fechas importantes
        public function mostrarFechasImportantes($identificador){
            $sql = "SELECT * FROM fechas_importantes WHERE id_convocatoria=:id order by id_fechasimportantes";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$identificador));
            $resultado = $sentenceSQL ->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json;
        }

        //mostrar meritos generales
        public function mostrarMeritosGenerales($identificador){
            $sql = "SELECT * FROM meritos_generales WHERE id_convocatoria=:id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$identificador));
            $resultado = $sentenceSQL ->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json;
        }

        //mostrar las reglas de meritos
        public function mostrarReglasMeritos($identificador){
            $sql = "SELECT * FROM reglas_meritos WHERE id_merito=:id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$identificador));
            $resultado = $sentenceSQL ->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json;
        }
        //mostrarReglasMeritos
        public function mostrarNormasMeritos($identificador){
            $sql = "SELECT * FROM normas_meritos WHERE id_regla=:id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$identificador));
            $resultado = $sentenceSQL ->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json;
        }
    }
    
?>