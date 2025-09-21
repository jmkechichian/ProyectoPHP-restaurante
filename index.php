   <?php

$pageTitle = "Inicio - Mi Sitio Web";
include 'templates/header.php';

//Conexión a la base de datos
include 'admin/bd.php';

//Banners
$sentencia=$conexion->prepare("SELECT * FROM tbl_banner limit 1");
$sentencia->execute();
$lista_banners = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Menú
$sentencia_menu = $conexion->prepare("SELECT * FROM tbl_menu");
$sentencia_menu->execute();
$lista_menu = $sentencia_menu->fetchAll(PDO::FETCH_ASSOC);

// IDs de Favoritos del Usuario (solo si está logueado)
$lista_ids_favoritos = [];
if (isset($_SESSION['user_id'])) {
    $id_usuario = $_SESSION['user_id'];

    $sentencia_favoritos = $conexion->prepare("SELECT ID_menu FROM tbl_favoritos WHERE ID_usuario = :id_usuario");
    $sentencia_favoritos->bindParam(':id_usuario', $id_usuario);
    $sentencia_favoritos->execute();

    $lista_ids_favoritos = $sentencia_favoritos->fetchAll(PDO::FETCH_COLUMN, 0);
}
?>




    <!-- Secciòn de Banner-->
    <section>
      <div class="banner">
          <div class="banner-content">

          <?php foreach($lista_banners as $banner) { 
            ?>
              <h1> <?php echo $banner['Nombre'];?> </h1>
              <p><?php echo $banner['Descripcion'];?></p>
              <button href="#" type="button" class="btn btn-outline-light btn-lg">Ver Menu</button>
          
          <?php } ?>
          
            </div>
      </div>
  </section>

    <br>
    <br>

<!-- SECCION MENU EL VIDEO ESTA CORTADO EN MIN 30-->
<!-- SECCION MENU -->
<section id="menu" class="container">
    <h2 class="text-center mb-4">Nuestro Menú</h2>
    <div class="row">
        <?php foreach ($lista_menu as $plato) { ?>
            <div class="col-md-6">
                <div class="dish-card card mb-4">
                    <!-- Agregar la imagen aquí -->
                    <?php if (!empty($plato['foto'])): ?>
                        <img src="images/<?php echo htmlspecialchars($plato['foto']); ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($plato['Nombre']); ?>"
                             style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <img src="images/default.jpg" 
                             class="card-img-top" 
                             alt="Imagen no disponible"
                             style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <!-- El resto del contenido permanece igual -->
                        <div class="d-flex justify-content-between">
                            <h5 class="dish-name mb-0"><?php echo htmlspecialchars($plato['Nombre']); ?></h5>
                            <div class="d-flex align-items-center">
                                <span class="dish-price fw-bold">$<?php echo htmlspecialchars($plato['Precio']); ?></span>

                                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'cliente'): ?>

                                    <!-- Botón de Favoritos -->
                                    <?php if (in_array($plato['ID'], $lista_ids_favoritos)): ?>
                                        <a href="cliente/favoritos/eliminar.php?id=<?php echo $plato['ID']; ?>&ref=index" class="btn btn-danger btn-sm ms-2" title="Quitar de favoritos">
                                            <i class="bi bi-heart-fill"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="cliente/favoritos/agregar.php?id=<?php echo $plato['ID']; ?>" class="btn btn-outline-danger btn-sm ms-2" title="Añadir a favoritos">
                                            <i class="bi bi-heart"></i>
                                        </a>
                                    <?php endif; ?>

                                    <!-- Añadir al Carrito -->
                                    <form action="cliente/carrito/agregar.php" method="post" style="display: inline;">
                                        <input type="hidden" name="id_producto" value="<?php echo $plato['ID']; ?>">
                                        <input type="hidden" name="cantidad" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm ms-1" title="Añadir al carrito">
                                            <i class="bi bi-cart-plus-fill"></i>
                                        </button>
                                    </form>

                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="dish-ingredients mt-2 pt-2 border-top border-dashed"><?php echo htmlspecialchars($plato['Descripcion']); ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

    
<!-- SECCION CHEFS-->

<section id="chefs "class="container md-4 text-center">
        <h2>Nuestros Chefs</h2>
        <p>Listado de nuestros chefs.</p>
        <div class="row">
        <div class="col-md-4">
          <div class="card">
            <img src="../restaurante/images/chef-1.jpg" class="card-img-top" alt="Chef 1">
              <div class="card-body">
                <h5 class="card-title">Chef Juan</h5>
                <p class="card-text">Especialista en cocina italiana.</p>
                <div class="social-icons">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
              </div>
          </div>
    </div>
    <div class="col-md-4">
          <div class="card">
            <img src="../restaurante/images/chef-2.jpg" class="card-img-top" alt="Chef 2">
              <div class="card-body">
                <h5 class="card-title">Chef Felipe</h5>
                <p class="card-text">Especialista en cocina mexicana.</p>
                <div class="social-icons">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
              </div>
          </div>
    </div>
    <div class="col-md-4">
          <div class="card">
            <img src="../restaurante/images/chef-3.jpg" class="card-img-top" alt="Chef 3">
              <div class="card-body">
                <h5 class="card-title">Chef Mati</h5>
                <p class="card-text">Especialista en cocina japonesa.</p>
                <div class="social-icons">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
              </div>
          </div>
    </div>
</div>

</section>

    <br>
    <br>


<!-- SECCION TESTIMONIOS-->
<section id="testiomonios" class="bg-light py-5">
        <div class="container">
        <h2 class="text-center mb-4">Testimonios</h2>
          <div class="row">
            <div class="col-md-6 d-flex">
              <div class="card mb-4 w-100">
                <div class="card-body">
                  <p class="card-text">"La comida es deliciosa y el servicio es excelente. ¡Volveré pronto!"</p>
                </div>
                <div class="card-footer text-muted">
                  - María López
                </div>
              </div>
            </div>
            <div class="col-md-6 d-flex">
              <div class="card mb-4 w-100">
                <div class="card-body">
                  <p class="card-text">"La comida es deliciosa y el servicio es excelente. ¡Volveré pronto!"</p>
                </div>
                <div class="card-footer text-muted">
                  - María López
                </div>
              </div>
            </div>
          </div>
</section>

<br>
<br>




<?php
include 'templates/footer.php';

?>
   
