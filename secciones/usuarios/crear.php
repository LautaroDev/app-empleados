<?php
include("../../templates/header.php");
include("../../db.php") ;

if ($_POST) {
  print_r( $_POST );
  //recolectamos los datos del POST
  $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
  $password=(isset($_POST["password"])?$_POST["password"]:"");
  $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
  //insertamos los registros
  $sentencia=$conexion->prepare("INSERT INTO tbl_usuarios(id,usuario,password,correo)
                      VALUES  (NULL,:usuario,:password,:correo)");
$sentencia->bindParam(":usuario",$usuario);
$sentencia->bindParam(":password",$password);
$sentencia->bindParam(":correo",$correo);
$sentencia->execute();

              
}


?> 

<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>
    <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="usuario" class="form-label">Nombre del usuario:</label>
            <input type="text"
              class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
          </div><!-- user -->
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password"
              class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
          </div><!-- password -->
          <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="text"
              class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
          </div><!-- email -->
          <button type="submit" class="btn btn-success">Agregar</button> 
          <a type="button" class="btn btn-danger" href="index.php">Cancelar</a>
      </form>
    </div>
</div>
<?php include("../../templates/footer.php") ?> 