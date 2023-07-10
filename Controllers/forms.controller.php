<?php     

    class FormController {

        

                            /* REGISTRAR
-----------------------------------------*/       

        static public function ctrGetRegisterPhp() {

            if(isset($_POST["enviar"])) {
                if(!empty($_POST["email"] && $_POST["pwd"])) {
                     
                        // expresión regular, solo lo haré a modo de ejemplo en valor 'nombre'
                    $patron = "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/"; 
                    if(preg_match($patron, $_POST["nombre"])) {
                        $token = md5($_POST["nombre"] . "+" . $_POST["email"]);
                        $table = "registro";
                        $data = array("token" => $token, "name" => $_POST["nombre"], "email" => $_POST["email"], "pwd" => $_POST["pwd"] );
                                        
                        $toRegister = FormsModel::mdlFormsToRegister($table, $data);
                        return $toRegister;
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p>No enviado. <br> Campo nombre no válido</p></div>";
                    }
                }
                else {
                    echo "<div class='text-center alert-danger rounded'><p>No enviado. <br> Campo/s vacío/s</p></div>";
                }
            }
        }

                            /* LISTAR REGISTROS
------------------------------------------------*/ 

        static public function ctrToListTable($token = null) {
            $result;
            try {
                $table = "registro";
                $result = FormsModel::mdlToListTable($table, $token);
            }
            catch(PDOException $ex) {
                echo "Error interno 'ToListTable()'. Error: " . $ex->getMessage();
            }
            return $result;
        }

        
                            /* LOGIN
----------------------------------------*/ 
    
        public function ctrToLogin() {
            $result = "";
                                            
            if(isset($_POST["submitIngreso"])) {
                if(!empty($_POST["emailIngreso"] && $_POST["pwdIngreso"])) {
                    $table = "registro";
                    $data = array("email" => $_POST["emailIngreso"], "pwd" => $_POST["pwdIngreso"]);
                    $result = FormsModel::mldToLogin($table, $data);
                }
                else {
                    echo "<p class='text-center alert-danger rounded'>Campos vacíos</p>";
                }
            }
            
            if($result == "OK") {                 
                FormsModel::mdlUpdateFailedAttemps($table, $data, 0); // Contador de logins incorrectos a cero

                $_SESSION["loginCheck"] = "OK"; // Si las credenciales son correctas se crea variable de sesión
                
                header("location: index.php?pages=home");
                exit;
            }
            else if($result == "KO") {
                echo "<div class='container'>
                      <p class='text-center alert-danger p-1 rounded'>Credenciales incorrectas</p>
                      </div>";
                           
                $checkFailedAttemps = FormsModel::mdlToListTable($table, $_POST["emailIngreso"]);  
                $failedAttemps = $checkFailedAttemps[0]->failed_attemps; 
                if($failedAttemps <= 3) {                               
                    $failedAttemps = ($checkFailedAttemps[0]->failed_attemps)+1;               
                    FormsModel::mdlUpdateFailedAttemps($table, $data, $failedAttemps);
                }
                else {
                    echo "<div class='container'>
                            <p class='text-center alert-warning p-1 rounded'>Límite de logins incorrectos superados. <br>Se remite a RECaptcha</p>
                         </div>";
                }
            }
            echo "<script>
                        if(window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                 </script>";
        }

                            /* ACTUALIZAR
------------------------------------------*/ 
        static public function ctrUpdate($token) {           
          
            if(isset($_POST["submitEdit"])) {
                if(!empty($_POST["nombreActualizar"] && $_POST["emailActualizar"] && $_POST["pwdActualizar"])) {
                    $table = "registro";
                        
                        // Para comprobar que el token obtenido de la vista y el token de la base de datos coinciden
                    $user = FormsModel::mdlToListTable($table, $token);
                    $checkToken = md5($user[0]->user_name . "+" . $user[0]->email);
                                                                                                           
                    if($checkToken == $token) {

                        $data = array( "token" => $token, "user_name" => $_POST["nombreActualizar"], "email" => $_POST["emailActualizar"], "pwd" => $_POST["pwdActualizar"]);
                        
                        $result = FormsModel::mdlUpdate($table, $data, $token);
                        return $result;
                    }
                    else {
                        echo "error en comparación de token"; // se pondría otro mensaje más profesional
                    }
                }
                else {
                    echo "<p class='text-center alert-danger rounded'>Campos vacíos</p>";
                    return;
                }
            }
        }

                            /* ELIMINAR
----------------------------------------*/ 

        public function ctrDelete() {

            if(isset($_POST["btn-delete"])) {
                if(isset($_POST["inputDelete"])) {
                    $table = "registro";
                    $token = $_POST["inputDelete"];

                        // comprobación de token obtenido y token generado en base de datos
                    $user = FormsModel::mdlToListTable($table, $token);
                    $checkToken = md5($user[0]->user_name . "+" . $user[0]->email);
                                                        
                    if($checkToken == $token) {

                        $delete = FormsModel::mdlDelete($table, $token);

                        if($delete == "OK") {
                            
                            echo "<script>
                                    if(window.history.replaceState) {
                                        window.history.replaceState(null, null, window.location.href);    
                                    }
                                    
                                    alert('Se va a proceder a eliminar el registro seleccionado');

                                    window.location.href = 'index.php?pages=home';
                                </script>";
                        }
                        else if($delete =="KO") {
                            echo "<script>
                                    alert('No se ha podido eliminar registro');        
                                </script>";
                        }
                        return $delete;
                    }
                    else {
                        echo "error en comparación de token";
                    }
                }
            }
        }
    }
