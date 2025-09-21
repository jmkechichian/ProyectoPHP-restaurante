<?php
$pageTitle = "Confirmar Pedido";
include '../../templates/header.php';

if (!isset($_SESSION['user_id']) || empty($_SESSION['carrito'])) {
    header("Location: index.php");
    exit();
}

$total = 0;
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Confirmar tu Pedido</h1>
    <p>Por favor, revisa tu pedido antes de confirmar la compra.</p>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['carrito'] as $id => $producto):
                $subtotal = $producto['precio'] * $producto['cantidad'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td>$<?php echo number_format($subtotal, 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Total a Pagar:</strong></td>
                <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="text-center mt-4">
        <form action="procesar-pedido.php" method="post">
            <a href="index.php" class="btn btn-secondary btn-lg">Volver al Carrito</a>
            <button type="submit" class="btn btn-success btn-lg">Confirmar y Pagar</button>
        </form>
    </div>
</div>
<br><br>
<?php include '../../templates/footer.php'; ?>