<?php
require_once '../../config.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id_pedido'])) {
    echo "<p class='text-danger'>Acceso no autorizado.</p>";
    exit();
}

$id_usuario = $_SESSION['user_id'];
$id_pedido = $_GET['id_pedido'];

// Consulta para obtener los detalles del pedido
$sentencia = $conexion->prepare("
    SELECT td.*, tm.Nombre, tm.foto 
    FROM tbl_detalle_pedidos td
    JOIN tbl_menu tm ON td.ID_menu = tm.ID
    WHERE td.ID_pedido = :id_pedido
");
$sentencia->bindParam(':id_pedido', $id_pedido);
$sentencia->execute();
$detalles_pedido = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Si se encontraron detalles, los mostramos en una tabla
if (count($detalles_pedido) > 0) {
?>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Foto</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles_pedido as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['Nombre']); ?></td>
                    <td><img src="../images/<?php echo htmlspecialchars($item['foto']); ?>" width="50" class="img-thumbnail"></td>
                    <td>$<?php echo number_format($item['precio_unitario'], 2); ?></td>
                    <td><?php echo $item['cantidad']; ?></td>
                    <td>$<?php echo number_format($item['precio_unitario'] * $item['cantidad'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php
} else {
    echo "<p>No se encontraron detalles para este pedido.</p>";
}
?>