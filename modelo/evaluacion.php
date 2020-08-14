<?php
    require_once("conexion.php");
    class Evaluacion extends Connexion{
        public function Evaluacion(){
            parent::__construct();
        }
        public function cerrarConexion(){
            $this->connexion_bd=null;
        }
        public function evaluacionDeConocimiento($idConvocatoria){
            $sql = "SELECT * FROM conocimientos WHERE id_convocatoria = :idCon ORDER BY id_conocimientos";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idCon"=>$idConvocatoria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        public function obtenerTitulosPruebas($idConvocatoria){
            $sql = "SELECT * FROM meritos_generales WHERE id_convocatoria = :idCon ORDER BY id_merito";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idCon"=>$idConvocatoria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        public function obtenerReglas($idMerito){
            $sql = "SELECT * FROM reglas_meritos WHERE id_merito = :idMerito";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idMerito"=>$idMerito));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        public function obtenerNormas($idRegla){
            $sql = "SELECT * FROM normas_meritos WHERE id_regla = :idRegla";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idRegla"=>$idRegla));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        public function obtenerConvocatoria($idConvocatoria){
            $sql = "SELECT * FROM convocatoria WHERE id_convocatoria = :clave";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":clave"=>$idConvocatoria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado[0];
        }
        public function obtenerClavePostReq($idMateria,$idPostulante){
            $sql = "SELECT * FROM postulante_requerimiento WHERE id_requerimiento = :idReq AND id_postulante = :idPos";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idReq"=>$idMateria,":idPos"=>$idPostulante));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado[0];
        }
        public function insertarNotasPostulante($id,$evaluacionMeritos,$evaluacionConocimientos,$notaTotalCM){
            $sql = "UPDATE postulante_requerimiento SET evaluacion_merito = :em ,evaluacion_conocimiento = :ec ,evaluacion_final =:ef  WHERE post_requis = :clave";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":em"=>$evaluacionMeritos,":ec"=>$evaluacionConocimientos,"ef"=>$notaTotalCM,":clave"=>$id));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado[0];
        }
    }
?>