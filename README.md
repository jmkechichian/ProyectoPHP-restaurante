Guía de Instalación del Sistema de Restaurante

Requisitos Previos
  -Servidor web (Apache, Nginx)
  -PHP 7.4 o superior
  -MySQL 5.7 o superior



Instrucciones de Instalación
  1. Clonar o descargar el repositorio
Con Git
git clone <url_del_repositorio>
cd restaurante
O descargar el ZIP y extraerlo en tu directorio web

  2. Configurar la base de datos
Acceder a MySQL
mysql -u root -p

Crear la base de datos
CREATE DATABASE restaurante CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

Crear usuario (opcional)
CREATE USER 'usuario_restaurante'@'localhost' IDENTIFIED BY 'password_seguro';
GRANT ALL PRIVILEGES ON restaurante.* TO 'usuario_restaurante'@'localhost';
FLUSH PRIVILEGES;

3. Importar la estructura de la base de datos
   # Con los datos de prueba que proporcionamos 
mysql -u root -p restaurante < database/restaurante.sql

  # Ingresando a phpMyAdmin e importar el archivo restaurante.sql

4. Configurar las variables de la aplicación
  Edita el archivo admin/bd.php con los datos de tu base de datos:
<?php
$servidor = "localhost";
$baseDatos = "restaurante";
$usuario = "usuario_restaurante";  // o "root"
$pass = "password_seguro";         // tu contraseña

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $error) {
    echo $error->getMessage();
}
?>

