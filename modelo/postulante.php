<?php
    require_once("conexion.php");
    class Postulante extends Connexion{
        public function Postulante(){
            parent::__construct();
        }
        public function cerrarConexion(){
            $this->connexion_bd=null;
        }

        //ajax
        public function obtenerPostulanteEspecifico($id,$materia){
            $sql = "SELECT nombre_postulante, telefono_postulante,documentos_postulante ,observaciones_postulante , fecha_entrega FROM postulante_requerimiento INNER JOIN postulante ON postulante_requerimiento.id_postulante = postulante.id_postulante WHERE postulante.id_postulante = :id AND id_requerimiento = :materia";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$id,":materia"=>$materia));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL->closeCursor();
            return $json;
        }
        //ajax
        public function actualizarDocumentosPostulante($clave,$idMateria,$cantDocumentosPos,$observacionesPos,$horaDeEntrega){
            $sql = "UPDATE postulante_requerimiento SET documentos_postulante = :catDoc , observaciones_postulante = :obs, fecha_entrega = :fechaEntrega where id_postulante = :post AND id_requerimiento = :req";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":catDoc"=>$cantDocumentosPos,":obs"=>$observacionesPos,":fechaEntrega"=>$horaDeEntrega,":post"=>$clave,":req"=>$idMateria));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado);
            $sentenceSQL->closeCursor();
            return $json;
        }

        //====================
        public function listaDeEvaluadores($idReq,$tipo){
            $sql = "SELECT * FROM comision_evaluadora WHERE tipo_evaluador = :tipo AND id_evaluador IN (SELECT id_evaluador FROM materia_evaluador WHERE id_requerimiento = :idReq)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":tipo"=>$tipo,":idReq"=>$idReq));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado;
        }
        public function insertarPostulante($nombre,$ci,$correo,$telefono,$pass){
            $sql = "INSERT INTO postulante(nombre_postulante,ci_postulante,correo_postulante,telefono_postulante,password_postulante) VALUES (:nombre,:ci,:correo,:telefono,:pass)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":nombre"=>$nombre,":ci"=>$ci,":correo"=>$correo,":telefono"=>$telefono,":pass"=>$pass));
            //$resultado = $sentenceSQL->fechAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            $this->cerrarConexion();
            return $resultado;
        }
        public function verificarPostulante($correo,$password){
            $sql = "SELECT * FROM postulante WHERE UPPER(correo_postulante) = UPPER(:correo) AND password_postulante = :pass";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":correo"=>$correo,":pass"=>$password));
            $resultado = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $this->cerrarConexion();
            $sentenceSQL->closeCursor();
            return $resultado[0];
        }
        //insertar convocatoria - postulante
        public function insertarConvocatoriaPostulante($convocatoria,$postulante){
            $sql = "INSERT INTO postulante_convocatoria(id_convocatoria,id_postulante) VALUES(:id_conv,:id_post)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $resultado = $sentenceSQL->execute(array(":id_conv"=>$convocatoria,":id_post"=>$postulante));
            if($resultado){
                $tmp = $this->obtenerClavePrimaria($convocatoria,$postulante);
                $res = $tmp['post_conv'];
            }else{
                $res = "";
            }
            $this->cerrarConexion();
            $sentenceSQL->closeCursor();
            return $resultado;
        }
        //obtener clave primaria
        public function obtenerClavePrimaria($convocatoria,$postulante){
            $sql = "SELECT * FROM postulante_convocatoria WHERE id_convocatoria = :id_conv AND id_postulante = :id_post";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id_conv"=>$convocatoria,":id_post"=>$postulante));
            $resultado = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $this->cerrarConexion();
            $sentenceSQL->closeCursor();
            return $resultado[0];
        }
        public function obtnerDatosPostulante($idPost){
            $sql = "SELECT * FROM postulante WHERE id_postulante = :id_post";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id_post"=>$idPost));
            $resultado = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $this->cerrarConexion();
            $sentenceSQL->closeCursor();
            return $resultado[0];
        }
        public function mostrarPostulantesInscritos($idRequerimiento){
            $sql = "SELECT * FROM postulante WHERE id_postulante  IN (SELECT id_postulante FROM postulante_requerimiento WHERE id_requerimiento = :id_req)";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id_req"=>$idRequerimiento));
            $resultado=$sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $resultado;
        }
    }
?>    