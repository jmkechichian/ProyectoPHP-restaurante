   <?php

    $pageTitle = "Inicio - Restaurante";
    include 'templates/header.php';

    //Conexión a la base de datos
    include './admin/bd.php';

    //Banners
    $sentencia = $conexion->prepare("SELECT * FROM tbl_banner limit 1");
    $sentencia->execute();
    $lista_banners = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    // Menu
    $sentencia_menu = $conexion->prepare("SELECT * FROM tbl_menu");
    $sentencia_menu->execute();
    $lista_menu = $sentencia_menu->fetchAll(PDO::FETCH_ASSOC);
    ?>

   <!-- Secciòn de Banner-->
   <section>
       <div class="banner">
           <div class="banner-content">

               <?php foreach ($lista_banners as $banner) {
                ?>
                   <h1> <?php echo $banner['Nombre']; ?> </h1>
                   <p><?php echo $banner['Descripcion']; ?></p>
                   <button href="#" type="button" class="btn btn-outline-light btn-lg">Ver Menu</button>

               <?php } ?>

           </div>
       </div>
   </section>

   <br>
   <br>


   <!-- SECCION CHEFS-->

   <section id="chefs " class="container md-4 text-center">
       <h2>Nuestros Chefs</h2>
       <p>Listado de nuestros chefs.</p>
       <div class="row">
           <div class="col-md-4">
               <div class="card">
                   <img src="./images/chef-1.jpg" class="card-img-top" alt="Chef 1">
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
                   <img src="./images/chef-2.jpg" class="card-img-top" alt="Chef 2">
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
                   <img src="./images/chef-3.jpg" class="card-img-top" alt="Chef 3">
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

   <!-- SECCION MENU -->
   <section id="menu" class="container">
       <h2 class="text-center mb-4">Menú</h2>
       <div class="row">
           <?php foreach ($lista_menu as $plato) { ?>
               <div class="col-md-6">
                   <div class="dish-card card mb-4">
                       <div class="card-body">
                           <div class="dish-header">
                               <h5 class="dish-name"><?php echo htmlspecialchars($plato['Nombre']); ?></h5>
                               <span class="dish-price">$<?php echo htmlspecialchars($plato['Precio']); ?></span>
                           </div>
                           <p class="dish-ingredients"><?php echo htmlspecialchars($plato['Descripcion']); ?></p>
                       </div>
                   </div>
               </div>
           <?php } ?>
       </div>
   </section>


   <?php
    include 'templates/footer.php';

    ?>