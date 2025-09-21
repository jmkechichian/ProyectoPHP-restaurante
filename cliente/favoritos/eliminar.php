<?php
require_once '../../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: favoritos.php");
    exit();
}

$id_usuario = $_SESSION['user_id'];
$id_menu = $_GET['id'];

$sentencia = $conexion->prepare("DELETE FROM tbl_favoritos WHERE ID_usuario = :id_usuario AND ID_menu = :id_menu");
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->bindParam(':id_menu', $id_menu);
$sentencia->execute();

$origen = $_GET['ref'] ?? 'favoritos';

if ($origen == 'index') {
    $url_redireccion = BASE_URL . '/index.php#menu';
} else {
    $url_redireccion = 'index.php';
}

header("Location: " . $url_redireccion);
exit();
