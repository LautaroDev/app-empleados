<?php  include('../../db.php');
if ($_POST) {
print_r($_POST);
    //recolectamos los datos del metodo POST
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:(""));
    //preparamos la inserccion de datos
    $sentencia = $conexion -> prepare("INSERT INTO tbl_puesto(id, nombredelpuesto)
                                       VALUES (null, :nombredelpuesto)");
    //asignando los valores que vienen del metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
    $sentencia-> execute();
    header("Location:index.php");
}

?> 





<?php include("../../templates/header.php") ?> 

<div class="card">
    <div class="card-header">
        Puestos
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="nombredelpuesto" class="form-label">Nombre Del Puesto:</label>
          <input type="text"
            class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
        </div>
        <button type="submit" class="btn btn-success">Agregar</button> 
        <a type="button" class="btn btn-danger" href="index.php">Cancelar</a>
    </form>
    </div>
</div>


<?php include("../../templates/footer.php") ?> 