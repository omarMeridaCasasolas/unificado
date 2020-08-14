<?php
   class Connexion{
        protected $connexion_bd;
        public function Connexion(){
            try{
                $this->connexion_bd = new PDO("pgsql:host=convocatoriasumss.cgto0udaapal.us-east-2.rds.amazonaws.com;port=5432;dbname=UMSSTIS","postgres","kirium2020");
                //$this->connexion_bd = new PDO("pgsql:host=localhost;port=5434;dbname=UMSSTIS","postgres","kirium");
                $this->connexion_bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->connexion_bd;
            }catch(Exception $e){
                echo $e->getMessage()."<br>";
                echo "Error en la linea ".$e->getLine();
            }
        }
        

    } 
?>
