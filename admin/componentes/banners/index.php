   <?php
// index.php
$pageTitle = "Banners - Panel de Control";
include '../../../templates/header.php';
include '../../bd.php';

if(isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    
    $senctencia=$conexion->prepare("DELETE FROM tbl_banner WHERE ID=:ID");
    $senctencia->bindParam(":ID",$txtID);
    $senctencia->execute();

    echo '<script>alert("Banner eliminado correctamente");</script>';
    echo '<script>window.location.href = "index.php";</script>';
}



$senctencia=$conexion->prepare("SELECT * FROM tbl_banner");
$senctencia->execute();
$resultado_lista_banners = $senctencia->fetchAll(PDO::FETCH_ASSOC);
?>



<br>
<br>

<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between">
            <div><h4 class="card-title">Panel Administrador de Banners</h4></div>
            <div class="text-end">
                <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Banner</a>
            </div>
        </div>
    </div>
  <div class="card-body">
    
    <p class="card-text text-center">Listado de Banners</p>

     <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Título del Banner</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Enlace</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado_lista_banners as $key => $value) { ?>
                <tr class="">
                    
                        <td scope="row"><?php echo $value['ID']; ?></td>
                        <td><?php echo $value['Nombre']; ?></td>
                        <td><?php echo $value['Descripcion']; ?></td>
                        <td><?php echo $value['Enlace']; ?></td>
                        <td>
                            <a name="" id="" class="btn btn-warning" href="editar.php?txtID=<?php echo $value['ID']; ?>" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $value['ID']; ?>" role="button">Borrar</a>    
                        </td>
                      
                </tr>
                <?php } ?>
                
            </tbody>
        </table>
  </div>
</div>


    <div class="card-footer text-muted">
        
</div>

</div>





</section>










<?php
include '../../../templates/footer.php';

?>
   
