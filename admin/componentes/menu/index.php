<?php
$pageTitle = "Menú - Panel de Control";
include '../../../templates/header-admin.php';
include '../../bd.php';

// SENTENCIA PARA ELIMINAR (DELETE)
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Buscar el nombre del archivo de la foto para borrarlo
    $sentencia = $conexion->prepare("SELECT foto FROM `tbl_menu` WHERE ID = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_foto = $sentencia->fetch(PDO::FETCH_LAZY);

    if (isset($registro_foto["foto"])) {
        if (file_exists("../../../images/" . $registro_foto["foto"])) {
            unlink("../../../images/" . $registro_foto["foto"]);
        }
    }

    // Borrar el registro de la base de datos
    $sentencia = $conexion->prepare("DELETE FROM `tbl_menu` WHERE ID = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    header("Location: index.php"); // Redireccionar
}

// SENTENCIA PARA LISTAR (SELECT)
$sentencia = $conexion->prepare("SELECT * FROM `tbl_menu`");
$sentencia->execute();
$lista_menu = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

</br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Plato al Menú</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_menu as $plato) { ?>
                        <tr class="">
                            <td><?php echo $plato['ID']; ?></td>
                            <td><?php echo $plato['Nombre']; ?></td>
                            <td><?php echo $plato['Descripcion']; ?></td>
                            <td><img src="../../../images/<?php echo $plato['foto']; ?>" width="50" alt="Foto del plato"></td>
                            <td>$<?php echo $plato['Precio']; ?></td>
                            <td>
                                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $plato['ID']; ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $plato['ID']; ?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../../templates/footer.php'; ?>