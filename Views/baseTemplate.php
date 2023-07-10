<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Document</title>
        
            <!-- PLUGINS CSS 
        ---------------------->
                    <!-- BOOTSTRAP - Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
            
            <!-- PLUGINS JS 
        ---------------------->
                    <!-- BOOTSTRAP - jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        
                    <!-- BOOTSTRAP - Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        
                    <!-- BOOTSTRAP - Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> 
                
                    <!-- FONTAWESOME -->
        <script src="https://kit.fontawesome.com/9151328e30.js" crossorigin="anonymous"></script>
    </head>

    <body>    
        <header class=" container-fluid">
            <h3 class="text-center py-3">LOGO</h3>
            <div class="container pb-3">
                <div class="">    
                    <i class="fa-sharp fa-solid fa-user"></i>
                </div>
                <div class="">
                    <?php echo ""; // nombre usuario; ?>
                </div>
            </div>
        </header>
    
        <main class="container-fluid ">
            <div class="container">
                <ul class="nav nav-justified py-2 nav-pills  bg-light">

                    <?php
                         $activeRegistro = "active";
                         $activeIngreso = "";
                         $activeHome = "";
                        if(isset($_GET["pages"])) {
                            if($_GET["pages"] == "registro") {
                                $activeRegistro = "active";
                            }
                            else if($_GET["pages"] == "ingreso") {
                                $activeIngreso = "active";
                                $activeRegistro = "";                               
                            }
                            else if($_GET["pages"] == "home") {
                                $activeHome = "active";
                                $activeRegistro = "";
                            }           
                            else if($_GET["pages"] == "edit") {
                                $activeHome = "";
                                $activeRegistro = "";  
                            }             
                            else {
                                $activeRegistro = "active";
                            }
                        }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link <?php echo $activeRegistro ?>" href="index.php?pages=registro">Registro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $activeIngreso ?>" href="index.php?pages=ingreso">Ingreso</a>
                    </li>
                    <li class="nav-item">
                        <a name="pages" class="nav-link <?php echo $activeHome ?>" href="index.php?pages=home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?pages=salir">Salir</a>
                    </li>
                </ul>
            </div>
    
    
            <section class="container-fluid py-5">
                <div class="container">
                    <?php    
                        if(isset($_GET["pages"])) {
                            if( $_GET["pages"] == "registro" ||
                                $_GET["pages"] == "ingreso" ||
                                $_GET["pages"] == "home" || 
                                $_GET["pages"] == "edit" ||
                                $_GET["pages"] == "salir") {
                                    include "pages/" . $_GET["pages"] . ".template.php";
                            }
                            else {
                                include "pages/error404.template.php";
                            }
                        }                    
                        else {
                            include "pages/registro.template.php";
                        }
                    ?>                     
                </div>
            </section>  
        </main>  
    </body>
</html>




