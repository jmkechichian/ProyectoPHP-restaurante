<?php

define('BASE_URL', '/restaurante/');
define('ROOT_PATH', __DIR__);

$servidor = "localhost";
$baseDatos = "restaurante";
$usuario = "root";
$pass = "";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("set names utf8");
} catch (PDOException $error) {
    error_log("Error de conexión: " . $error->getMessage());
    die("Error de conexión a la base de datos.");
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
