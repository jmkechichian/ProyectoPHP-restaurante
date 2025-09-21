<?php
$pageTitle = "Editar Menú - Panel de Control";
include '../../../templates/header.php';

// RECUPERAR DATOS PARA MOSTRAR EN EL FORMULARIO
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_menu` WHERE ID = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $nombre = $registro['Nombre'];
    $descripcion = $registro['Descripcion'];
    $foto = $registro['foto'];
    $precio = $registro['Precio'];
}

// PROCESAR LA ACTUALIZACIÓN
if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $precio = (isset($_POST['precio'])) ? $_POST['precio'] : "";

    // Actualizar los campos de texto
    $sentencia = $conexion->prepare("UPDATE `tbl_menu` 
                                     SET Nombre = :nombre, Descripcion = :descripcion, Precio = :precio
                                     WHERE ID = :id");
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":precio", $precio);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Actualizar la foto si se sube una nueva
    if ($_FILES["foto"]["name"] != "") {
        $foto = (isset($_FILES['foto']['name'])) ? $_FILES['foto']['name'] : "";
        $fecha_foto = new DateTime();
        $nombre_foto = $fecha_foto->getTimestamp() . "_" . $foto;
        $tmp_foto = $_FILES['foto']['tmp_name'];

        // Borrar la foto anterior
        $sentencia = $conexion->prepare("SELECT foto FROM `tbl_menu` WHERE ID = :id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_foto = $sentencia->fetch(PDO::FETCH_LAZY);

        if (isset($registro_foto["foto"])) {
            if (file_exists("../../../images/" . $registro_foto["foto"])) {
                unlink("../../../images/" . $registro_foto["foto"]);
            }
        }

        // Subir la nueva foto
        move_uploaded_file($tmp_foto, "../../../images/" . $nombre_foto);

        // Actualizar el nombre de la foto en la BD
        $sentencia = $conexion->prepare("UPDATE `tbl_menu` SET foto = :foto WHERE ID = :id");
        $sentencia->bindParam(":foto", $nombre_foto);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
    }

    header("Location: index.php");
}
?>

</br>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Editar Plato del Menú</div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="txtID" class="form-label">ID:</label>
                    <input readonly type="text" class="form-control" name="txtID" id="txtID" value="<?php echo $txtID; ?>" />
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del plato:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required />
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>" required />
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto:</label>
                    <br>
                    <img src="../../../images/<?php echo $foto; ?>" width="70" alt="Foto del plato">
                    <input type="file" class="form-control mt-2" name="foto" id="foto" />
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="number" step="0.01" class="form-control" name="precio" id="precio" value="<?php echo $precio; ?>" required />
                </div>

                <button type="submit" class="btn btn-success">Actualizar</button>
                <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php include '../../../templates/footer.php'; ?>