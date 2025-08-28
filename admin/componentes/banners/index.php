   <?php
// index.php
$pageTitle = "Banners - Panel de Control";
include '../../../templates/header-admin.php';
include '../../bd.php';

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
                    <th scope="col">Enlace Call To Action</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado_lista_banners as $key => $value) { ?>
                <tr class="">
                    
                        <td scope="row"><?php echo print_r($value['ID']); ?></td>
                        <td><?php echo $value['Nombre']; ?></td>
                        <td><?php echo print_r($value['Descripcion']); ?></td>
                        <td><?php echo print_r($value['Nombre']); ?></td>
                        <td>
                            <a name="" id="" class="btn btn-warning" href="editar.php" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="#" role="button">Borrar</a>    
                        </td>
                      
                </tr>
                <?php } ?>
                
            </tbody>
        </table>
  </div>
</div>


    <div class="card-footer text-muted">
        Footer
</div>

</div>





</section>










<?php
include '../../../templates/footer.php';

?>
   
