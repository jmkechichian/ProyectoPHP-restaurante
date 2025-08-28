   <?php
// index.php
$pageTitle = "Inicio - Mi Sitio Web";
include 'templates/header.php';
?>

    <!-- Banner que ocupa todo el ancho -->
    <section>
      <div class="banner">
          <div class="banner-content">
              <h1>¡Bienvenido!</h1>
              <p>Este banner ocupa todo el ancho de la pantalla sin importar el tamaño del dispositivo</p>
              <button href="#" type="button" class="btn btn-outline-light btn-lg">Ver Menu</button>
          </div>
      </div>
  </section>

    <br>
    <br>

    
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

<!-- SECCION MENU EL VIDEO ESTA CORTADO EN MIN 30-->
<section>
  <h2 class="text-center mb-4">Menu</h2>
    <!-- Menú -->
    <div class="container">
        <!-- Entradas -->
        <h3 class="category-title">Entradas</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="dish-card card">
                    <div class="card-body">
                        <div class="dish-header">
                            <h5 class="dish-name">Ceviche Mixto</h5>
                            <span class="dish-price">S/ 28.90</span>
                        </div>
                        <p class="dish-ingredients">Pescado, mariscos, limón, cebolla, camote, choclo, cancha serrana.</p>
                        <div>
                            <span class="badge bg-primary">Mariscos</span>
                            <span class="badge badge-spicy">Picante</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dish-card card">
                    <div class="card-body">
                        <div class="dish-header">
                            <h5 class="dish-name">Tequeños de Queso</h5>
                            <span class="dish-price">S/ 18.50</span>
                        </div>
                        <p class="dish-ingredients">Masa de harina de trigo rellena de queso blanco, acompañada de guacamole.</p>
                        <div>
                            <span class="badge badge-vegetarian">Vegetariano</span>
                            <span class="badge bg-info text-dark">Frito</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Platos Principales -->
        <h3 class="category-title">Platos Principales</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="dish-card card">
                    <div class="card-body">
                        <div class="dish-header">
                            <h5 class="dish-name">Lomo Saltado</h5>
                            <span class="dish-price">S/ 32.90</span>
                        </div>
                        <p class="dish-ingredients">Lomo de res, cebolla, tomate, ají amarillo, papas fritas, arroz.</p>
                        <div>
                            <span class="badge bg-primary">Carne</span>
                            <span class="badge badge-popular">Popular</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dish-card card">
                    <div class="card-body">
                        <div class="dish-header">
                            <h5 class="dish-name">Arroz con Mariscos</h5>
                            <span class="dish-price">S/ 35.50</span>
                        </div>
                        <p class="dish-ingredients">Arroz, calamar, camarones, mejillones, almejas, ají amarillo, culantro.</p>
                        <div>
                            <span class="badge bg-primary">Mariscos</span>
                            <span class="badge badge-spicy">Picante</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dish-card card">
                    <div class="card-body">
                        <div class="dish-header">
                            <h5 class="dish-name">Pollo a la Brasa</h5>
                            <span class="dish-price">S/ 38.90</span>
                        </div>
                        <p class="dish-ingredients">Pollo marinado con romero, sillao, ají panca, acompañado de papas y ensalada.</p>
                        <div>
                            <span class="badge bg-primary">Pollo</span>
                            <span class="badge badge-popular">Popular</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dish-card card">
                    <div class="card-body">
                        <div class="dish-header">
                            <h5 class="dish-name">Risotto de Hongos</h5>
                            <span class="dish-price">S/ 26.90</span>
                        </div>
                        <p class="dish-ingredients">Arroz arbóreo, hongos portobello, parmesano, vino blanco, caldo de verduras.</p>
                        <div>
                            <span class="badge badge-vegetarian">Vegetariano</span>
                            <span class="badge bg-success">Saludable</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Postres -->
        <h3 class="category-title">Postres</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="dish-card card">
                    <div class="card-body">
                        <div class="dish-header">
                            <h5 class="dish-name">Suspiro Limeño</h5>
                            <span class="dish-price">S/ 15.90</span>
                        </div>
                        <p class="dish-ingredients">Manjarblanco, merengue de vainilla, vino oporto, canela.</p>
                        <div>
                            <span class="badge bg-secondary">Dulce</span>
                            <span class="badge badge-popular">Popular</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dish-card card">
                    <div class="card-body">
                        <div class="dish-header">
                            <h5 class="dish-name">Mazamorra Morada</h5>
                            <span class="dish-price">S/ 12.50</span>
                        </div>
                        <p class="dish-ingredients">Maíz morado, frutas, membrillo, harina de camote, clavo de olor, canela.</p>
                        <div>
                            <span class="badge bg-secondary">Dulce</span>
                            <span class="badge badge-vegetarian">Vegetariano</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</section>


<?php
include 'templates/footer.php';

?>
   
