<?php
    require_once("conexion.php");
    class ConvocatoriaUnica extends Connexion{
        public function ConvocatoriaUnica(){
            parent::__construct();
        }
        public function cerrarConexion(){
            $this->connexion_bd=null;
        }
        function detallesConvocatoria($idConvocatoria){
            $sql = "SELECT * FROM convocatoria where id_convocatoria = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$idConvocatoria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $resultado[0];
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }

        public function crearConvocatoria($tituloConvocatoria,$gestionConvocatoria,$departamentoConvocatoria,$descripcionConvocatoria,$visible){
            $sql= "INSERT INTO convocatoria(nombre_convocatoria,descripcion_conv,gestion_convocatoria,departamento,visible) VALUES (:titulo,:descripcion,:gestion,:departamento,:visible)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":titulo"=>$tituloConvocatoria,":descripcion"=>$descripcionConvocatoria,":gestion"=>$gestionConvocatoria,":departamento"=>$departamentoConvocatoria,":visible"=>$visible));
            $resultado=$this->connexion_bd->lastInsertId('convocatoria_id_convocatoria_seq');
            $sentenceSQL->closeCursor();
            return $resultado;
        }
        public function agregarRequerimientoDocente($idConvocatoria,$idCantidad,$idHoras,$idDestino){
            $sql = "INSERT INTO requerimientos(id_convocatoria,cantidad_requerimiento,cant_horas,destino_requerimiento) VALUES(:idCon,:idCant,:idHoras,:idDest)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":idCon"=>$idConvocatoria,":idCant"=>$idCantidad,":idHoras"=>$idHoras,":idDest"=>$idDestino));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }
        public function obtenerRequerimientosDocente($idConvocatoria){
            $sql = "SELECT * FROM requerimientos WHERE id_convocatoria = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$idConvocatoria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }
        public function eliminarRequerimiento($idRequerimiento){
            $sql = "DELETE FROM requerimientos WHERE id_requerimiento = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$idRequerimiento));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }
        public function editarRequerimiento($idRequerimiento){
            $sql = "SELECT * FROM requerimientos WHERE id_requerimiento = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$idRequerimiento));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $res = $resultado[0];
            $json = json_encode($res);
            $sentenceSQL -> closeCursor();
            return $json;
        }
        public function actualizarRequerimientoDocente($claveReqEspecifica,$idCantidad,$idHoras,$idDestino){
            $sql = "UPDATE requerimientos SET  cantidad_requerimiento = :cant, cant_horas = :horas, destino_requerimiento = :dest WHERE id_requerimiento = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":cant"=>$idCantidad,":horas"=>$idHoras,":dest"=>$idDestino,":id"=>$claveReqEspecifica));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json;
        }
        //docuemntacion
        public function agregarDocumentacion($idConvocatoria,$documento){
            $sql = "INSERT INTO documentos (id_convocatoria,descripcion_documento) VALUES(:idCon,:idDocumento)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":idCon"=>$idConvocatoria,":idDocumento"=>$documento));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }

        public function obtenerDocumentacion($idConvocatoria){
            $sql = "SELECT * FROM documentos WHERE id_convocatoria = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$idConvocatoria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json; 
        }

        //presentacion 
        function agregarFormaPresentacion($idConvocatoria,$idFormaPresentacion){
            $sql = "UPDATE convocatoria SET forma_presentacion = :forma WHERE id_convocatoria = :idCon";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":form"=>$idFormaPresentacion,":idCon"=>$idConvocatoria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json;
        }
        function actualizarDocumentos($idConvocatoria,$formaPresentacion){
            $sql = "UPDATE convocatoria SET forma_presentacion = :forma WHERE id_convocatoria = :idCon";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":forma"=>$formaPresentacion,":idCon"=>$idConvocatoria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL -> closeCursor();
            return $json;
        }
        //Metodos post
        function actualizarPresentacion($idConvocatoria,$formaPresentacion,$fechaPresentacion){
            $sql = "UPDATE convocatoria SET forma_presentacion = :forma, fecha_presentacion = :fecha WHERE id_convocatoria = :idCon";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":forma"=>$formaPresentacion,":fecha"=>$fechaPresentacion, ":idCon"=>$idConvocatoria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL -> closeCursor();
            return $resultado;
        }
        function obtenerPresentacion($idConvocatoria){
            $sql = "SELECT * FROM convocatoria where id_convocatoria = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id"=>$idConvocatoria));
            $resultado = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $resultado[0];
            $sentenceSQL -> closeCursor();
            return $resultado; 
        }
    }
?>