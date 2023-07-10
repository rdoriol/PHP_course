<?php
    require_once "conexion.model.php";

    class FormsModel {

                        /* REGISTRAR
----------------------------------------- */

        static public function mdlFormsToRegister($table, $data) {
            $check ="KO";
            
            try {                                                                                           // variables ocultas o de sustitución (por seguidad)
                $stm = Conexion::conectar()->prepare("INSERT INTO $table(token, user_name, email, pwd) VALUES (:token, :user_name, :email, :pwd)");  
                    
                    // bindParam= vincula una variable oculta en un prepare de statement con el valor que recibirá
                $stm->bindParam(":token", $data["token"], PDO::PARAM_STR);
                $stm->bindParam(":user_name", $data["name"], PDO::PARAM_STR);
                $stm->bindParam(":email", $data["email"], PDO::PARAM_STR);
                $stm->bindParam(":pwd", $data["pwd"], PDO::PARAM_STR);
                
                if($stm->execute()) {
                    $check = "OK";
                } else {
                    print_r(Conexion::conectar()->errorInfo());
                }

                // $stm->close();
                //$stm = null;
            }
            catch(PDOException $ex) {
                echo "error interno " . $ex->getMessage();
                $stm->close();
                $stm = null;
            }
            return $check;
        }

                        /* LISTAR REGISTROS
----------------------------------------- */

        static public function mdlToListTable($table, $email=null, $token=null) {
            try {
                if(isset($token)) {
                    $sql = "SELECT * FROM $table WHERE token= '$token'";
                }
                else if(isset($email)) {
                    $sql = "SELECT * FROM $table WHERE email= '$email'";
                }
                else {
                    $sql = "SELECT *,DATE_FORMAT(date_register, '%d/%m/%Y') AS date_register FROM $table ORDER BY ID DESC";
                }
                
                $stm = Conexion::conectar()->prepare($sql);
               
                if($stm->execute() && $stm->rowCount() > 0) {
                    while($rowItem = $stm->fetchObject()) {     
                        $data[] =  $rowItem;                              
                    }
                    return $data;
                }
                else {
                    return null;
                    echo "<p>No hay registros en la base de datos.</p>";
                }                
            }
            catch(PDOException $ex) {
                echo "Error interno 'toList(). Error: " . $ex->getMessage();
            }

            $stm->close();
            $stm = null;
        }

                        /* LOGIN
----------------------------------*/

        static public function mldToLogin($table, $data) {
            $validation = "KO";
            try {
                $registerList = self::mdlToListTable($table);
                $email = $data["email"];                       
                $pwd = $data["pwd"]; 
                
                for($i =0; $i < count($registerList); $i++) {                     
                                        
                    if($registerList[$i]->email == $email && $registerList[$i]->pwd == $pwd) {
                        
                        $validation = "OK";
                        
                        break;
                    }
                }
            }
            catch(PDOException $ex) {
                echo "Error interno mldToLogin(). Error " . $ex->getMessage();
            }
            return $validation;
        }

                        /* ACTUALIZAR
----------------------------------*/

        static public function mdlUpdate($table, $data, $token) {
            $check = "KO";
            try {
                $sql ="UPDATE $table SET user_name= :user_name, email= :email, pwd= :pwd WHERE token= :token";
                $stmt = Conexion::conectar()->prepare($sql);
                
                $stmt->bindParam(":token", $data["token"], PDO::PARAM_STR);
                $stmt->bindParam(":user_name", $data["user_name"], PDO::PARAM_STR);
                $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
                $stmt->bindParam(":pwd", $data["pwd"], PDO::PARAM_STR);
                
                if($stmt->execute()) {
                    $check = "OK";
                }
            }
            catch(PDOException $ex) {
                echo "Error interno mdlUpdate(). Error: " .$ex->getMessage();
                return; //¿necesario?
            }
            return $check;
        }

                        /* ELIMINAR
----------------------------------*/

        static public function mdlDelete($table, $token) {
            $check = "KO";
            try {
                $sql = "DELETE FROM $table WHERE token= :token";
                $stmt = Conexion::conectar()->prepare($sql);
                
                $stmt->bindParam(":token", $token, PDO::PARAM_STR);

                if($stmt->execute()) {
                    $check = "OK";
                }
            }
            catch(PDOException $ex) {
                echo "Error interno mdlDelete(). Error: " .$ex->getMessage();
                return; //¿necesario?
            }
            return $check;
        }


                /* ACTUALIZAR INTENTOS FALLIDOS
------------------------------------------------*/

        static public function mdlUpdateFailedAttemps($table, $data, $failedAttemps) {
            $check = "KO";
            try {
                $sql = "UPDATE $table SET failed_attemps= :failed_attemps WHERE email= :email";
                $stmt = Conexion::conectar()->prepare($sql);
                $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
                $stmt->bindParam(":failed_attemps", $failedAttemps, PDO::PARAM_INT);

                if($stmt->execute()) {
                    $check = "OK";
                }
            }
            catch(PDOException $ex) {
                echo "Error interno mdlUpdateFailedAttemps(). Error: " . $ex->getMessage();
            }
            return $check;
        }
    }



