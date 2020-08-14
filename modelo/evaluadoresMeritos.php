<?php
    require_once("conexion.php");
    class Evaluador extends Connexion{
        public function Evaluador(){
            parent::__construct();
        }
        public function cerrarConexion(){
            $this->connexion_bd=null;
        } 
        public function verificarEvaluador($correo,$pass){
            $sql = "SELECT * from comision_evaluadora where correo_evaluador = :correo AND password_evaluador = :pass";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":correo"=>$correo,":pass"=>$pass));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        public function obtenerListaMaterias($id){
            $sql = "SELECT  DISTINCT id_convocatoria FROM requerimientos WHERE id_requerimiento IN (SELECT id_requerimiento from materia_evaluador where id_evaluador = :id)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$id));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        public function obtenerConvocatoriaParticular($id){
            $sql = "SELECT * from convocatoria where id_convocatoria = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$id));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado[0];
        }
        public function obtenerMateriasCompletas($idEvaluador,$idConvovcatoria){
            $sql = "SELECT * FROM requerimientos WHERE id_convocatoria = :idConv AND id_requerimiento IN (SELECT id_requerimiento FROM materia_evaluador WHERE  id_evaluador = :id)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":idConv"=>$idConvovcatoria,":id"=>$idEvaluador));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        public function listaDeAlumnosInscritos($idRequerimiento){
            $sql = "SELECT * FROM postulante WHERE id_postulante IN (SELECT id_postulante FROM postulante_requerimiento WHERE id_requerimiento = :id)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$idRequerimiento));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado;
        }

        public function postulanteHabilitadoDocumentos($idPostulante,$idMateria){
            $sql = "SELECT * FROM postulante_requerimiento WHERE id_postulante = :idPost AND id_requerimiento = :idMateria";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":idPost"=>$idPostulante,":idMateria"=>$idMateria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado[0];
        }
    }
?>