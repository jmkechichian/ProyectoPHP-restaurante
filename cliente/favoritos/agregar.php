<?php
require_once '../../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_usuario = $_SESSION['user_id'];
$id_menu = $_GET['id'];

$sentencia = $conexion->prepare("SELECT * FROM tbl_favoritos WHERE ID_usuario = :id_usuario AND ID_menu = :id_menu");
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->bindParam(':id_menu', $id_menu);
$sentencia->execute();

if ($sentencia->rowCount() == 0) {
    $sentencia = $conexion->prepare("INSERT INTO tbl_favoritos (ID_usuario, ID_menu) VALUES (:id_usuario, :id_menu)");
    $sentencia->bindParam(':id_usuario', $id_usuario);
    $sentencia->bindParam(':id_menu', $id_menu);
    $sentencia->execute();
}

header("Location: " . BASE_URL . "index.php#menu");
exit();
