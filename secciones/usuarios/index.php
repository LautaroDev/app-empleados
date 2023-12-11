<?php include("../../db.php") ;

$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_tbl_usuarios  =  $sentencia->fetchAll(PDO::FETCH_ASSOC);

?> 




<?php include("../../templates/header.php") ?> 
<h1>lista usuarios</h1>


<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" 
        href="crear.php" role="button">
        Agregar Usuarios
        </a>
    </div>
    <div class="card-body"> 
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre del usuario</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_tbl_usuarios as $registro ) { ?>
                    <tr class="">
                        <td scope="row"> <?php echo $registro['id'] ?> </td>
                        <td><?php echo $registro['usuario'] ?></td>
                        <td><?php echo $registro['password'] ?></td>
                        <td><?php echo $registro['correo'] ?></td>
                        <td>
                            <input name="btneditar" id="btneditar" class="btn btn-info" type="button" value="Editar">
                            <input name="btnborrar" id="btnborrar" class="btn btn-danger" type="button" value="Eliminar">
                        </td>
                    </tr>
               <?php  }?>
            </tbody>
        </table>
</div>
    </div>

</div>



<?php include("../../templates/footer.php") ?> 