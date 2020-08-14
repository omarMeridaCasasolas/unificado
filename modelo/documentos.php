<?php
    require_once("conexion.php");
    class Documento extends Connexion{
        public function Documento(){
            parent::__construct();
        }
        public function cerrarConexion(){
            $this->connexion_bd=null;
        }
       
        public function buscarDocumentacion($idMateria,$idPostulante){
            $sql = "SELECT * FROM evaluacion_documentos WHERE id_requerimiento = :idRequi AND id_postulante = :idPos" ;
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idRequi"=>$idMateria,":idPos"=>$idPostulante));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado;
        }

        public function obtenerDescripcionDocumento($id){
            $sql = "SELECT * FROM documentos WHERE id_documentos = :id " ;
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$id));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            if($resultado[0]){
                return $resultado[0];
            }
            return "";
        }

        public function obtenerAsignaturaUnica($idMat){
            $sql = "SELECT * FROM requerimientos WHERE id_requerimiento = :clave";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":clave"=>$idMat));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado[0]; 
        }
        public function obtenerPostulanteUnico($clave){
            $sql = "SELECT * FROM postulante WHERE id_postulante = :clave";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":clave"=>$clave));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado[0]; 
        }
        public function obtenerListaDocumentos($idConv){
            $sql = "SELECT * FROM documentos WHERE id_convocatoria = :clave";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":clave"=>$idConv));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado; 
        }
        public function obtenerClaveRelacion($idPost,$idMat){
            $sql = "SELECT * FROM postulante_requerimiento WHERE id_requerimiento = :idReq AND id_postulante = :idPost";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idReq"=>$idMat,":idPost"=>$idPost));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado[0]; 
        }
        public function ingresarTablaEvaluacion_documentos($idDocumento,$idMateria,$idPostulante,$postulante_materia,$temporal){
            $sql = "INSERT INTO evaluacion_documentos(id_documentos,id_requerimiento,id_postulante,post_requis,evaluacion_documento) VALUES(:a,:b,:c,:d,:e)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":a"=>$idDocumento,":b"=>$idMateria,":c"=>$idPostulante,":d"=>$postulante_materia,":e"=>$temporal));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado; 
        }
        public function documentosAceptados($postulante_materia){
            $sql = "UPDATE postulante_requerimiento SET documentos_comp = :a WHERE post_requis = :b ";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":a"=>true,":b"=>$postulante_materia));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado; 
        }
    }
?>