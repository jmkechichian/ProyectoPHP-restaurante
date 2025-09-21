<?php
$pageTitle = "Mi Carrito de Compras";
include '../../templates/header.php';

$total = 0;
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Mi Carrito 🛒</h1>

    <?php if (!empty($_SESSION['carrito'])): ?>
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Foto</th>
                    <th>Precio</th>
                    <th style="width: 150px;">Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['carrito'] as $id => $producto):
                    $subtotal = $producto['precio'] * $producto['cantidad'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td><img src="../../images/<?php echo htmlspecialchars($producto['foto']); ?>" width="70" class="img-thumbnail"></td>
                        <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                        <td>
                            <form action="actualizar.php" method="post" class="d-flex">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>" min="1" class="form-control form-control-sm" style="width: 60px;">
                                <button type="submit" name="action" value="update" class="btn btn-sm btn-info ms-2">OK</button>
                            </form>
                        </td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <form action="actualizar.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button type="submit" name="action" value="remove" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2"><strong>$<?php echo number_format($total, 2); ?></strong></td>
                </tr>
            </tfoot>
        </table>
        <div class="text-end">
            <a href="checkout.php" class="btn btn-success btn-lg">Proceder al Pago</a>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            Tu carrito está vacío. ¡Visita nuestro <a href="../../index.php#menu" class="alert-link">menú</a> para añadir productos!
        </div>
    <?php endif; ?>
</div>
<br><br>

<?php include '../../templates/footer.php'; ?>