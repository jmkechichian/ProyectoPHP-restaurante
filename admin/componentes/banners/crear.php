   <?php
// index.php
$pageTitle = "Banners - Panel de Control";
include '../../../templates/header-admin.php';
include '../../bd.php';



if ($_POST) {
  
    
    $titulo = $_POST['titulo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $link = $_POST['link'] ?? '';

    $sentencia = $conexion->prepare
            ("INSERT INTO `tbl_banner` (`ID`, `Nombre`, `Descripcion`, `Enlace`) 
               VALUES (NULL, :titulo, :descripcion, :link);");

   $sentencia->bindParam(':titulo', $titulo);
   $sentencia->bindParam(':descripcion', $descripcion);
   $sentencia->bindParam(':link', $link);
   
    if($sentencia->execute()) {
      
        echo '<script>alert("Banner agregado correctamente");</script>';
     
        echo '<script>window.location.href = "index.php";</script>';
    } else {
        echo '<script>alert("Error al agregar el banner");</script>';
    }
    exit(); 
}

?>
</br>
<div class="card">
   <div class="card-header">Agregar Banner</div>
   <div class="card-body">
     <form action="" method="post">

     <div class="mb-3">
      <label for="titulo" class="form-label">Título:</label>
      <input
         type="text"
         class="form-control"
         name="titulo"
         id="titulo"
         aria-describedby="helpId"
         placeholder="Escribe el título del banner"
      />
     </div>

     <div class="mb-3">
      <label for="descripcion" class="form-label">Descripcion:</label>
      <input
         type="text"
         class="form-control"
         name="descripcion"
         id="descripcion"
         aria-describedby="helpId"
         placeholder="Escribe la descripcion del banner"
      />
     </div>

     <div class="mb-3">
      <label for="link" class="form-label">Elance Call To Action:</label>
      <input
         type="text"
         class="form-control"
         name="link"
         id="link"
         aria-describedby="helpId"
         placeholder="Escribe el link para el banner"
      />
     </div>
     
     
   </div>
   <div class="card-footer text-end">

   <button type="submit" class="btn btn-success"> Confirmar </button>
   <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
   </form>
</div>
</div>


<?php
include '../../../templates/footer.php';

?>
   
