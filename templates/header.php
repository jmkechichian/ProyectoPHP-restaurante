<?php
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Restaurante'; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>style.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

      <?php // El título del Navbar cambia si es admin
      $brand_title = "Restaurante JFM";
      $brand_link = BASE_URL . "index.php";
      if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'administrador') {
        $brand_title = "Panel de Administrador";
        $brand_link = BASE_URL . "admin/index.php";
      }
      ?>
      <a class="navbar-brand" href="<?php echo $brand_link; ?>"><?php echo $brand_title; ?></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">

        <?php if (isset($_SESSION['user_id'])) {
          // El usuario ha iniciado sesión
        ?>
          <?php if ($_SESSION['user_type'] == 'administrador') { ?>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL; ?>admin/index.php">
                  <i class="bi bi-speedometer2"></i> Panel Principal
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL; ?>index.php">
                  <i class="bi bi-house-door-fill"></i> Ver Sitio Web
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                  <i class="bi bi-pencil-square"></i> Administrar
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>admin/componentes/banners/">
                      <i class="bi bi-images"></i> Banners
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>admin/componentes/menu/">
                      <i class="bi bi-card-list"></i> Menú
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL; ?>user/logout.php">
                  <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                </a>
              </li>
            </ul>

          <?php } else { // Si no es admin, es cliente 
          ?>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item"><span class="nav-link text-info">¡Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>cliente/favoritos"><i class="bi bi-heart-fill"></i> Mis Favoritos</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>cliente/carrito"><i class="bi bi-cart3"></i> Mi Carrito</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>cliente/historial"><i class="bi bi-clock-history"></i> Mis Compras</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>user/logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a></li>
            </ul>

          <?php } ?>

        <?php } else { ?>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php#menu"><i class="bi bi-card-list"></i> Menú</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php#chefs"><i class="bi bi-person-badge"></i> Chefs</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php#testimonios"><i class="bi bi-chat-left-text"></i> Testimonios</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>user/login.php"><i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>user/register.php"><i class="bi bi-person-plus-fill"></i> Registrarse</a></li>
          </ul>
        <?php } ?>

      </div>
    </div>
  </nav>

  <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <?php if (isset($_SESSION['flash_message'])): ?>
      <div class="toast show align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body"><i class="bi bi-check-circle-fill"></i> <?php echo $_SESSION['flash_message']; ?></div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
      <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>
  </div>

  <main>