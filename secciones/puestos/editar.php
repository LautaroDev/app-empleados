<?php
include("../../templates/header.php");
include("../../db.php");    


if (isset( $_GET['txtID'] )) {
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    
    $sentencia = $conexion -> prepare("SELECT * FROM tbl_puesto WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia-> execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $nombredelpuesto=$registro["nombredelpuesto"];
}
if ($_POST) {
        //recolectamos los datos del metodo POST
        $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
        $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:(""));
        //preparamos la inserccion de datos
        $sentencia = $conexion -> prepare("UPDATE  tbl_puesto SET nombredelpuesto=:nombredelpuesto WHERE id=:id");
        //asignando los valores que vienen del metodo POST (los que vienen del formulario)
        $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
        $sentencia->bindParam(":id", $txtID);
        $sentencia-> execute();
        header("Location:index.php");
    }
  
?>




<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
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
          <label for="nombredelpuesto" class="form-label">Nombre Del Puesto:</label>
          <input
            type="text"
            value="<?php echo $nombredelpuesto; ?>"
            class="form-control"
            name="nombredelpuesto"
            id="nombredelpuesto"
            aria-describedby="helpId"
            placeholder="Nombre del puesto"
            />

        </div>
        <button type="submit" class="btn btn-success">Actualizar</button> 
        <a type="button" class="btn btn-danger" href="index.php">Cancelar</a>
    </form>
    </div>
</div>
<?php include("../../templates/footer.php") ?> 