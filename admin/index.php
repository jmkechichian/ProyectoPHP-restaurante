<?php
require_once __DIR__ . '/../config.php';
$pageTitle = "Panel de Control";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'administrador') {
  // Usamos la URL base del sitio para la redirección
  header('Location: ' . BASE_URL . 'login.php');
  exit();
}

include '../templates/header.php';
?>

<div class="container mt-5">
  <div class="p-5 bg-light rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
      <p class="col-md-8 fs-4">Este es el panel de control. Desde aquí puedes administrar todo el contenido del sitio web. Utiliza las tarjetas de acceso rápido para ir a la sección que necesites.</p>
    </div>
  </div>

  <div class="row align-items-md-stretch mt-4">

    <div class="col-md-4 mb-4">
      <div class="h-100 p-5 text-bg-primary rounded-3 text-center">
        <h2><i class="bi bi-images"></i> Banners</h2>
        <p>Administra los banners de la página principal.</p>
        <a class="btn btn-outline-light" href="<?php echo BASE_URL; ?>admin/componentes/banners/" role="button">Gestionar</a>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="h-100 p-5 bg-light border rounded-3 text-center">
        <h2><i class="bi bi-card-list"></i> Menú</h2>
        <p>Añade, edita o elimina platos del menú.</p>
        <a class="btn btn-outline-secondary" href="<?php echo BASE_URL; ?>admin/componentes/menu/" role="button">Gestionar</a>
      </div>
    </div>
  </div>
</div>

<?php
include '../templates/footer.php';
?>