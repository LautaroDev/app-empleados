<?php 
include("../../templates/header.php");
include("../../db.php");
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : '';

    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $usuario = $registro['usuario'];
    $password = $registro['password'];
    $correo = $registro['correo'];
}

if ($_POST) {
    // Recolectamos los datos del método POST
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : '';
    $usuario = (isset($_POST["usuario"])) ? $_POST["usuario"] : "";
    $password = (isset($_POST["password"])) ? $_POST["password"] : "";
    $correo = (isset($_POST["correo"])) ? $_POST["correo"] : "";

    // Preparamos la inserción de datos
    $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET 
                                    usuario=:usuario,
                                    password=:password,
                                    correo=:correo  
                                    WHERE id=:id");

    // Asignando los valores que vienen del método POST (los que vienen del formulario)
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":id", $txtID);

    // Ejecutamos la consulta
    if ($sentencia->execute()) {
        echo "¡Registro actualizado correctamente!";
        header("Location:index.php");
    } else {
        echo "Error al actualizar el registro.";
    }
}
?>
<!-- Resto del código HTML -->
<h1>EDITAR USUARIOS</h1>
<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>
    
    <form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="txtID" class="form-label">ID:</label>
        <input
            type="text"
            value="<?php echo $txtID; ?>"
            class="form-control"
            readonly
            name="txtID"
            id="txtID"
            aria-describedby="helpId"
            placeholder="ID"
        />
    </div>

    <div class="mb-3">
        <label for="usuario" class="form-label">Nombre del usuario:</label>
        <input type="text"
            class="form-control" value="<?php echo $usuario; ?>"  name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
    </div><!-- user -->

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password"
            class="form-control" value="<?php echo $password; ?>" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
    </div><!-- password -->

    <div class="mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="text"
            class="form-control" value="<?php echo $correo; ?>" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
    </div><!-- email -->

    <button type="submit" class="btn btn-success">Actualizar</button> 
    <a type="button" class="btn btn-danger" href="index.php">Cancelar</a>
</form>

    </div>
</div>
<?php include("../../templates/footer.php") ?> 