<?php

$servidor="localhost";
$baseDatos="restaurante";
$usuario="root";
$pass="";

try{

    $conexion= new PDO("mysql:host=$servidor; dbname=$baseDatos", $usuario, $pass);
    echo "Conexión exitosa";
} catch(Exception $error){
    echo $error->getMessage();
}

?>