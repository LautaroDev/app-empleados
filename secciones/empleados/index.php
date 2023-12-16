<?php include("../../templates/header.php") ;
include("../../db.php") ;

$sentencia = $conexion->prepare("SELECT * ,
/* incluimos una sentencia adicional para llamar al nombre del idpuesto*/
(SELECT nombredelpuesto 
FROM tbl_puesto 
WHERE tbl_puesto.id=tbl_empleados.idpuesto LIMIT 1)  AS puesto
FROM `tbl_empleados`");
$sentencia->execute();
$lista_tbl_empleados  =  $sentencia->fetchAll(PDO::FETCH_ASSOC);  
?> 

<br>
<h2>Empleados</h2>
<div class="card">    
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" 
        href="crear.php" role="button">
        Agregar Registro
        </a>

    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">apellido</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach ($lista_tbl_empleados as $registro){ ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro['id'];?></td>
                        <td scope="row">
                            <?php echo $registro['primernombre']; ?>
                            <?php echo $registro['segundonombre']; ?>
                        </td>
                        <td>                             
                            <?php echo $registro['primerapellido']; ?>
                            <?php echo $registro['segundoapellido']; ?>
                        </td>
                        <td><?php echo $registro['foto']; ?></td>
                        <td><?php echo $registro['cv']; ?></td>
                        <td><?php echo $registro['puesto']; ?></td>
                        <td><?php echo $registro['fechadeingreso']; ?></td>
                        <td>
                            <a name="" id="" class="btn btn-primary" href="#" role="button">Carta</a>
                            <a name="" id="" class="btn btn-info" href="editar.php" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php }  ?> 
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<?php include("../../templates/footer.php") ?> 