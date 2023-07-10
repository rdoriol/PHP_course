<?php
    class Conexion {

        static public function conectar() {
            $host = "localhost";
            $dbName = "curso-php";
            $user = "roberto10";
            $pwd = "Zcaracola10r";
            $connectString = "mysql: host=$host; dbname=$dbName";
            try {                
                $db = new PDO($connectString, $user, $pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                // $db->execute("set names utf8"); con esta línea daba error
                //echo "exito conexión";
            }
            catch(PDOException $ex) {
                echo "Error de conexión a base de datos. Error: " . $ex->getMessage();
                return null;
            }
            return $db;
        }
    }
