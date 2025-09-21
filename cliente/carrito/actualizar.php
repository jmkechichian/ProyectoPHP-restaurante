<?php
require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id'];
    $action = $_POST['action'];

    if (isset($_SESSION['carrito'][$id_producto])) {
        if ($action === 'update') {
            $cantidad = (int)$_POST['cantidad'];
            if ($cantidad > 0) {
                $_SESSION['carrito'][$id_producto]['cantidad'] = $cantidad;
            } else {
                // Si la cantidad es 0 o menos, eliminamos el producto
                unset($_SESSION['carrito'][$id_producto]);
            }
        } elseif ($action === 'remove') {
            unset($_SESSION['carrito'][$id_producto]);
        }
    }
}

// Redirigir de vuelta a la página del carrito
header('Location: index.php');
exit();
