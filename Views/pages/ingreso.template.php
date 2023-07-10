<h1 class="text-center">Ingreso</h1>

<div class="d-flex justify-content-center">

  <form class="p-5 bg-dark rounded" action="" method="post">

    <div class="form-group">
        <label class="text-white" for="email">Correo Electrónico</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-sharp fa-solid fa-envelope"></i></span>
          </div>
          <input type="email" class="form-control" placeholder="Enter email" id="email" name="emailIngreso">
        </div>
    </div>

    <div class="form-group">
        <label class="text-white" for="pwd">Contraseña</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Enter password" id="pwd" name="pwdIngreso">
        </div>
    </div>
    
    <?php 
        $result = new FormController();
        $result->ctrToLogin();       
    ?>
    
    <div class="text-center">
      <button type="submit" class="btn btn-primary" name="submitIngreso">Acceder</button>
    </div>
  </form> 
</div>