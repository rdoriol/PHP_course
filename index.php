<?php
    require_once "./Controllers/baseTemplate.controller.php";
    
    require_once "./Controllers/forms.controller.php";
    require_once "./Models/forms.model.php";
   

    // para probar conexión:
    //require_once "./Models/conexion.php";

        // Renderiza en pantalla navegador el template base
    $baseTemplate = new TemplateController();
    $baseTemplate->ctrGetTemplatePhp();

        // prueba de conexión
    //$conect = Conexion::conectar();
   
