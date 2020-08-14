<?php
    require_once("conexion.php");
    class Departamento extends Connexion{
        public function Departamento(){
            parent::__construct();
        }
        public function cerrarConexion(){
            $this->connexion_bd=null;
        }
        public function getDepartamentos(){
            $sql= "SELECT nombre_departamento FROM departamento";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute();
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL->closeCursor();
            return $json;
        }
    }
?>
