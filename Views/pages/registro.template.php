<h1 class="text-center">Registro</h1>

<div class="d-flex justify-content-center">

  <form class="p-5 bg-dark rounded" action="" method="post">

    <div class="form-group">
        <label class="text-white" for="nombre">Nombre</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Enter name" id="nombre" name="nombre">
        </div>
    </div>

    <div class="form-group">
        <label class="text-white" for="email">Correo Electrónico</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-sharp fa-solid fa-envelope"></i></span>
          </div>
          <input type="email" class="form-control" placeholder="Enter e-mail" id="email" name="email">
        </div>
    </div>

    <div class="form-group">
        <label class="text-white" for="pwd">Contraseña:</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Enter password" id="pwd" name="pwd">
        </div>
    </div>

    <?php 
      /* INSTANCIACIÓN DE OBJETOS CON MÉTODOS NO ESTÁTICOS 
    $print = new FormController();
    $print->ctrGetRegisterPhp();
      */

      /* LLAMADA A MÉTODO ESTÁTICO */

      $registro = FormController::ctrGetRegisterPhp();

      if($registro == "OK") {
        
        echo "<script>
                if(window.history.replaceState) {
                  window.history.replaceState(null, null, window.location.href);
                }
              </script>";
        echo "<div class='alert alert-success text-center'>Registro enviado con éxito</div>";
        }
      else {
        echo "<script>
                if(window.history.replaceState) {
                  window.history.replaceState(null, null, window.location.href);
                }
              </script>";
              
        //echo $registro;
      }     
    ?>

    <div class="text-center">
      <button type="submit" class="btn btn-primary center" name="enviar">Enviar</button>
    </div>
  </form>




</div>