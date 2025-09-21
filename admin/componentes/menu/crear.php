<?php
$pageTitle = "Agregar Menú - Panel de Control";
include '../../../templates/header.php';

if ($_POST) {
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $precio = (isset($_POST['precio'])) ? $_POST['precio'] : "";

    $foto = (isset($_FILES['foto']['name'])) ? $_FILES['foto']['name'] : "";
    $fecha_foto = new DateTime();
    $nombre_foto = $fecha_foto->getTimestamp() . "_" . $foto; // Crear un nombre único para la foto
    $tmp_foto = $_FILES['foto']['tmp_name'];

    if ($tmp_foto != "") {
        move_uploaded_file($tmp_foto, "../../../images/" . $nombre_foto);
    }

    // Sentencia de inserción
    $sentencia = $conexion->prepare("INSERT INTO `tbl_menu` (`Nombre`, `Descripcion`, `foto`, `Precio`) 
                                     VALUES (:nombre, :descripcion, :foto, :precio)");

    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":foto", $nombre_foto);
    $sentencia->bindParam(":precio", $precio);
    $sentencia->execute();

    header("Location: index.php");
}
?>

</br>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Agregar Plato al Menú</div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del plato:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required />
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" required />
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto:</label>
                    <input type="file" class="form-control" name="foto" id="foto" />
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="number" step="0.01" class="form-control" name="precio" id="precio" placeholder="Precio" required />
                </div>

                <button type="submit" class="btn btn-success">Agregar</button>
                <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php include '../../../templates/footer.php'; ?>