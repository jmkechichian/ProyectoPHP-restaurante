<?php
$pageTitle = "Mis Favoritos";
include '../../templates/header.php';
include '../../admin/bd.php';



if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['user_id'];

$sentencia = $conexion->prepare("
    SELECT tbl_menu.* FROM tbl_menu 
    JOIN tbl_favoritos ON tbl_menu.ID = tbl_favoritos.ID_menu 
    WHERE tbl_favoritos.ID_usuario = :id_usuario
");
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->execute();
$lista_favoritos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Mis Platos Favoritos ❤️</h1>

    <?php if (count($lista_favoritos) > 0): ?>
        <div class="row">
            <?php foreach ($lista_favoritos as $plato) { ?>
                <div class="col-md-6 col-lg-4">
                    <div class="dish-card card mb-4">
                        <img src="../../images/<?php echo htmlspecialchars($plato['foto']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($plato['Nombre']); ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <div class="dish-header">
                                <h5 class="dish-name"><?php echo htmlspecialchars($plato['Nombre']); ?></h5>
                                <span class="dish-price">$<?php echo htmlspecialchars($plato['Precio']); ?></span>
                            </div>
                            <p class="dish-ingredients"><?php echo htmlspecialchars($plato['Descripcion']); ?></p>

                            <a href="eliminar.php?id=<?php echo $plato['ID']; ?>" class="btn btn-danger w-100">
                                <i class="bi bi-trash-fill"></i> Eliminar de Favoritos
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Aún no has añadido ningún plato a tus favoritos. ¡Explora nuestro <a href="<?php echo BASE_URL; ?>index.php#menu" class="alert-link">menú</a> y encuentra algo delicioso!
        </div>
    <?php endif; ?>
</div>

<?php include '../../templates/footer.php'; ?>