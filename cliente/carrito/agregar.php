<?php
require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    $sentencia = $conexion->prepare("SELECT * FROM tbl_menu WHERE ID = :id");
    $sentencia->bindParam(':id', $id_producto);
    $sentencia->execute();
    $producto = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        $item_carrito = [
            'nombre' => $producto['Nombre'],
            'precio' => $producto['Precio'],
            'foto' => $producto['foto'],
            'cantidad' => $cantidad
        ];

        if (isset($_SESSION['carrito'][$id_producto])) {
            $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;
        } else {
            $_SESSION['carrito'][$id_producto] = $item_carrito;
        }

        // Mensaje flash para confirmar que el producto fue añadido
        $_SESSION['flash_message'] = "¡'" . htmlspecialchars($producto['Nombre']) . "' fue añadido al carrito!";
    }
}

header('Location: ../../index.php#menu');
exit();
