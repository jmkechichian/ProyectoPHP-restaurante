<?php
$pageTitle = "Mi Historial de Compras";
include '../../templates/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['user_id'];
// Consultar todos los pedidos del usuario, ordenados por fecha descendente
$sentencia = $conexion->prepare("SELECT * FROM tbl_pedidos WHERE ID_usuario = :id_usuario ORDER BY fecha DESC");
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->execute();
$lista_pedidos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Mi Historial de Compras</h1>

    <?php if (count($lista_pedidos) > 0): ?>
        <div class="accordion" id="accordionPedidos">
            <?php foreach ($lista_pedidos as $pedido): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $pedido['ID']; ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $pedido['ID']; ?>">
                            <strong>Pedido #<?php echo $pedido['ID']; ?></strong> - Fecha: <?php echo date("d/m/Y H:i", strtotime($pedido['fecha'])); ?> - Total: $<?php echo number_format($pedido['total'], 2); ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $pedido['ID']; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionPedidos">
                        <div class="accordion-body" data-pedido-id="<?php echo $pedido['ID']; ?>">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            Aún no has realizado ninguna compra.
        </div>
    <?php endif; ?>
</div>
<br><br>

<?php include '../../templates/footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var accordion = document.getElementById('accordionPedidos');

        accordion.addEventListener('show.bs.collapse', function(event) {
            let accordionBody = event.target.querySelector('.accordion-body');
            let pedidoId = accordionBody.getAttribute('data-pedido-id');

            if (accordionBody.getAttribute('data-loaded') !== 'true') {
                fetch(`obtener-detalle.php?id_pedido=${pedidoId}`)
                    .then(response => response.text())
                    .then(html => {
                        accordionBody.innerHTML = html;
                        accordionBody.setAttribute('data-loaded', 'true');
                    })
                    .catch(error => {
                        console.error('Error al cargar el detalle del pedido:', error);
                        accordionBody.innerHTML = "<p class='text-danger'>No se pudo cargar el detalle. Inténtelo de nuevo.</p>";
                    });
            }
        });
    });
</script>