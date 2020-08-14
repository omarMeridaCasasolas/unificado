<?php
    require_once("conexion.php");
    class Evaluador extends Connexion{
        public function Evaluador(){
            parent::__construct();
        }
        public function cerrarConexion(){
            $this->connexion_bd=null;
        }

        public function getListaEvaluadores($idMateria,$tipo){
            $sql = "SELECT * FROM comision_evaluadora WHERE tipo_evaluador = :tipo AND id_evaluador IN (SELECT id_evaluador FROM materia_evaluador WHERE id_requerimiento = :idReq)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":tipo"=>$tipo,":idReq"=>$idMateria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }

        public function addEvaluadores($idMateria,$tipo,$idName,$idCi,$idCorreo,$idTelefono,$idCargo,$idDepartamento,$idPass){
            $sql = "INSERT INTO comision_evaluadora(nombre_evaluador,ci_evaluador,correo_evaluador,telefeno_evaluador,cargo_evaluador,carrera_evaluador,password_evaluador,tipo_evaluador) 
            VALUES(:idName,:idCi,:idCorreo,:idTelefono,:idCargo,:idDepar,:idPass,:tipoEvaluador)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idName"=>$idName,":idCi"=>$idCi,":idCorreo"=>$idCorreo,":idTelefono"=>$idTelefono,":idCargo"=>$idCargo,":idDepar"=>$idDepartamento,":idPass"=>$idPass,":tipoEvaluador"=>$tipo));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }

        public function getClavePrimariaEvaluador($idName,$idCi){
            $sql = "SELECT id_evaluador FROM comision_evaluadora WHERE nombre_evaluador = :idName AND ci_evaluador= :idCi";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idName"=>$idName,":idCi"=>$idCi));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado; 
        }

        public function subirMateriaEvaluador($idMateria,$claveDesifrada){
            $sql = "INSERT INTO materia_evaluador(id_requerimiento,id_evaluador) VALUES(:idMateria,:idClave)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idMateria"=>$idMateria,":idClave"=>$claveDesifrada));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json;
        }

        public function EliminarEvaluador($clave,$idMateria){
            $sql = "DELETE FROM materia_evaluador WHERE id_requerimiento = :idMateria AND id_evaluador = :idEvaluador";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idMateria"=>$idMateria,":idEvaluador"=>$clave));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json;
        } 
        public function obtenerEvaluadorEspecifico($clave){
            $sql = "SELECT * FROM comision_evaluadora WHERE id_evaluador = :clave";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":clave"=>$clave));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }
        public function actualizarEvaluadorEspecifico($clave,$idName,$idCi,$idCorreo,$idTelefono,$idCargo,$idDepartamento){
            $sql = "UPDATE comision_evaluadora SET nombre_evaluador = :idName, ci_evaluador = :idCi, correo_evaluador = :idCorreo, telefeno_evaluador = :idTelefono, cargo_evaluador = :idCargo, carrera_evaluador = :idDepar WHERE id_evaluador = :ciEvaluador";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":idName"=>$idName,":idCi"=>$idCi,":idCorreo"=>$idCorreo,":idTelefono"=>$idTelefono,":idCargo"=>$idCargo,":idDepar"=>$idDepartamento,":ciEvaluador"=>$clave));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }
        //Ajax
        public function listaEvaluadoresObtenidos($busqueda){
            $sql = "SELECT * FROM comision_evaluadora WHERE nombre_evaluador LIKE :myName AND id_evaluador NOT IN (SELECT id_evaluador FROM materia_evaluador)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":myName"=>"%".$busqueda."%"));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }

    }
?>