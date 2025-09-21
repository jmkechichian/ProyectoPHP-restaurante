   <?php

$pageTitle = "Banners - Panel de Control";
include '../../../templates/header.php';

if(isset($_GET['txtID'])) {
      //Identifico el ID del registro a editar
   $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    
      //Realizo la consulta para obtener los datos actuales del banner
   $senctencia=$conexion->prepare("SELECT * FROM tbl_banner WHERE ID=:ID");
   $senctencia->bindParam(":ID",$txtID);
   $senctencia->execute();

      //Ejecuto la consulta y obtengo los datos
   $registros=$senctencia->fetch(PDO::FETCH_LAZY);
   $titulo=$registros['Nombre'];
   $descripcion=$registros['Descripcion'];
   $link=$registros['Enlace'];
  
}

if($_POST) {
  
    $txtID = $_POST['txtID'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $link = $_POST['link'] ?? '';

    $sentencia = $conexion->prepare
            ("UPDATE `tbl_banner` 
              SET 
              `Nombre` = :titulo,
              `Descripcion` = :descripcion,
              `Enlace` = :link
              WHERE `tbl_banner`.`ID` = :ID;");

   $sentencia->bindParam(':ID', $txtID);
   $sentencia->bindParam(':titulo', $titulo);
   $sentencia->bindParam(':descripcion', $descripcion);
   $sentencia->bindParam(':link', $link);
   
   
    if($sentencia->execute()) {
      
        echo '<script>alert("Banner actualizado correctamente");</script>';
     
        echo '<script>window.location.href = "index.php";</script>';
    } else {
        echo '<script>alert("Error al actualizar el banner");</script>';
    }
    exit();

   }


?>

</br>
<div class="card">
   <div class="card-header">Editar Banner</div>
   <div class="card-body">
      
     <form action="" method="post">

     <div class="mb-3">
      <label for="titulo" class="form-label">ID:</label>
      <input
         type="ID"
         class="form-control"
         value="<?php echo $txtID; ?>"
         name="txtID"
         id="txtID"
         aria-describedby="helpId"
         placeholder=""
      />
     </div>

     <div class="mb-3">
      <label for="titulo" class="form-label">Título:</label>
      <input
         type="text"
         class="form-control"
         value="<?php echo $titulo; ?>"
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
         value="<?php echo $descripcion; ?>"
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
         value="<?php echo $link; ?>"
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
   
