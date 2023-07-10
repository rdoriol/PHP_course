<?php
      // Condición para proteger acceso a zona restringida para logins
    if(!isset($_SESSION["loginCheck"])) {
        header("location: index.php?pages=ingreso");
        return;
    }
    else {
        if($_SESSION["loginCheck"] != "OK") {
            header("location: index.php?pages=ingreso");
            return;    
        }
    }
    
?>  


<h1 class="text-center">Inicio</h1>

<div class="container">
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Fecha registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $toList = FormController::ctrToListTable();
                foreach($toList as $item): 
            ?>            
            <tr>
                <td><?php echo $item->id; ?></td>
                <td><?php echo $item->user_name; ?></td>
                <td><?php echo $item->email; ?></td>
                <td><?php echo $item->date_register; ?></td>
                <td>
                    <div class="btn-group">
                        <a href="index.php?pages=edit&token=<?php echo $item->token; ?>" class="btn btn-warning m-1"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                        <form method="post"> 
                            <input type="hidden" value="<?php echo $item->token; ?>" name="inputDelete">
                            <button type="submit" class="btn btn-danger m-1" name="btn-delete"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach ?>
            <?php 
                $delete = new FormController();
                $delete->ctrDelete();
            ?>
        </tbody>
    </table>
</div>
