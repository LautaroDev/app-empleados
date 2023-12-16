<?php
 include("../../templates/header.php"); 
 include("../../db.php");
 
 $token = bin2hex(random_bytes(32));
 $_SESSION['csrf_token'] = $token;

 print_r($token);

 if ($_POST) {
  //recolectamos los datos del POST
  $primernombre=(isset($_POST["primernombre"])?$_POST["primernombre"]:"");
  $segundonombre=(isset($_POST["segundonombre"])?$_POST["segundonombre"]:"");
  $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
  $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");

  //Datos de los archivos
  $foto=(isset($_FILES["foto"]["name"])?$_FILES["foto"]["name"]:"");
  $cv=(isset($_FILES["cv"]["name"])?$_FILES["cv"]["name"]:"");
 
  $puesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
  $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");

  //reviso que los campos no esten vacios.
  if (empty($primernombre) || empty($segundonombre) || empty($primerapellido) || empty($segundoapellido) || empty($foto) || empty($cv) || empty($puesto) || empty($fechadeingreso)) {
      echo "Error: Todos los campos deben ser completados.";
      exit();
  }

  // Verifica el tipo de archivo para las imágenes y PDF
  $tipoImagen = ['image/jpeg', 'image/png', 'image/gif'];
  $tipoPDF = ['application/pdf'];

  if (!in_array($_FILES['foto']['type'], $tipoImagen) || !in_array($_FILES['cv']['type'], $tipoPDF)) {
      echo "Error: Formato de archivo no válido para la foto o el CV.";
      exit();
  }

  if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo "Error: Token CSRF no válido.";
    exit();
}

  

  //insertamos los registros

  $sentencia=$conexion->prepare("INSERT INTO 
  tbl_empleados(`id`, `primernombre`,`segundonombre`,`primerapellido`,`segundoapellido`,`foto`,`cv`,`idpuesto`,`fechadeingreso`)
  VALUES  (NULL, :primernombre ,:segundonombre ,:primerapellido,:segundoapellido ,:foto ,:cv ,:idpuesto ,:fechadeingreso);");
  
  $sentencia->bindParam(":primernombre",$primernombre);
  $sentencia->bindParam(":segundonombre",$segundonombre);
  $sentencia->bindParam(":primerapellido",$primerapellido);
  $sentencia->bindParam(":segundoapellido",$segundoapellido);

  $sentencia->bindParam(":foto",$foto);
  $sentencia->bindParam(":cv",$cv);

  $sentencia->bindParam(":idpuesto",$puesto);
  $sentencia->bindParam(":fechadeingreso",$fechadeingreso);

  $sentencia->execute();



 }

 

$sentencia=$conexion->prepare("SELECT * FROM  `tbl_puesto`");
$sentencia->execute();
$lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?> 

<br>
<div class="card">
    <div class="card-header">
        Datos del Empleado
    </div>
    <div class="card-body">
       
    <form action="" method="post" enctype="multipart/form-data">

    <!-- Incluir el token CSRF en el formulario -->
    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">

    <div class="mb-3">
      <label for="primernombre" class="form-label">Primer Nombre</label>
      <input type="text"
        class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer Nombre">
    </div>

    <div class="mb-3">
      <label for="segundonombre" class="form-label">Segundo Nombre</label>
      <input type="text"
        class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo Nombre">
    </div>
    <div class="mb-3">
      <label for="primerapellido" class="form-label">Primer Apellido</label>
      <input type="text"
        class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="apellido">
    </div>
    <div class="mb-3">
      <label for="segundoapellido" class="form-label">Segundo apellido</label>
      <input type="text"
        class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
    </div>

    <div class="mb-3">
      <label for="" class="form-label">Foto</label>
      <input type="file"    
        class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
    </div>

    <div class="mb-3">
      <label for="" class="form-label">CV(PDF)</label>
      <input type="file"    
        class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="cv">
    </div>

    <div class="mb-3">
        <label for="idpuesto" class="form-label">Puesto</label>

        <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
            <?php foreach ($lista_tbl_puestos as $registro) { ?>
                <option value="<?php echo $registro['id'];?>">
                <?php echo $registro['nombredelpuesto']; ?></option>
            <?php } ?>
        </select>

    </div>

    <div class="mb-3">
      <label for="fechadeingreso" class="form-label">Fecha de Ingreso:</label>
      <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de Ingreso a la empresa">
    </div>

    <button type="submit" class="btn btn-success">Agregar Registro</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
</div>

<?php include("../../templates/footer.php") ?> 