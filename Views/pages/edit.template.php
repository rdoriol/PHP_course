<?php
  $user_name = "";  
  $email = "";
  $pwd = "";
  if(isset($_GET["token"]) && $_GET["token"] != "") {
    $list = FormController::ctrToListTable($_GET["token"]);
    $user_name = $list[0]->user_name;
            echo $user_name;
    $email = $list[0]->email;
    $pwd = $list[0]->pwd;

    $update = FormController::ctrUpdate($_GET["token"]);
  }
  else {
    header("location: index.php?pages=home");
  }
?>

<h1 class="text-center">Editar datos usuario</h1>

<div class="d-flex justify-content-center">

  <form class="p-5 bg-dark rounded" action="" method="post">

    <div class="form-group">
       
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Escriba nuevo nombre" id="nombre" name="nombreActualizar" value=<?php echo $user_name; ?> >
        </div>
    </div>

    <div class="form-group">
       
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-sharp fa-solid fa-envelope"></i></span>
          </div>
          <input type="email" class="form-control" placeholder="Escriba nuevo e-mail" id="email" name="emailActualizar" value=<?php echo $email; ?> >
        </div>
    </div>

    <div class="form-group">
       
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Escriba nueva contraseña" id="pwd" name="pwdActualizar" />
        </div>
    </div>

    <?php 
      /* INSTANCIACIÓN DE OBJETOS CON MÉTODOS NO ESTÁTICOS 
    $print = new FormController();
    $print->ctrGetRegisterPhp();
      */

      /* LLAMADA A MÉTODO ESTÁTICO */

      // $update = FormController::ctrUpdate($_GET["id"]);

      if($update == "OK") {
        
        echo "<script>
                if(window.history.replaceState) {
                  window.history.replaceState(null, null, window.location.href);
                }
              </script>";
        echo "<div class='alert alert-success text-center'>Actualización de datos realizada</div>";
        }
      else {
        echo "<script>
                if(window.history.replaceState) {
                  window.history.replaceState(null, null, window.location.href);
                }
              </script>";
      }     
    ?>

    <div class="text-center">
      <button type="submit" class="btn btn-primary center" name="submitEdit">Actualizar</button>
    </div>
  </form>




</div>