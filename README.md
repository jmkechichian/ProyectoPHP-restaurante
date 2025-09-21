Guía de Instalación del Sistema de Restaurante


📋 Requisitos Previos
XAMPP instalado y configurado

PHP 7.4 o superior

MySQL 5.7 o superior

Navegador web moderno

🚀 Preparación del Proyecto
1-Coloca el proyecto en la carpeta adecuada:
  C:\xampp\htdocs\restaurante\

2-Accede al proyecto desde tu navegador:
  http://localhost/restaurante/

📥 Instalación
1. Clonar o Descargar el Repositorio
Opción A - Con Git:
  git clone <url_del_repositorio>
  cd restaurante
Opción B - Descarga Directa:
-Descarga el archivo ZIP desde GitHub
-Extrae el contenido en C:\xampp\htdocs\restaurante\

2. Configurar la Base de Datos
A través de phpMyAdmin:
Abre phpMyAdmin: http://localhost/phpmyadmin

Ejecuta los siguientes comandos SQL:
  -- Crear la base de datos
  CREATE DATABASE restaurante CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
  
  -- Crear usuario (opcional)
  CREATE USER 'usuario_restaurante'@'localhost' IDENTIFIED BY 'password_seguro';
  GRANT ALL PRIVILEGES ON restaurante.* TO 'usuario_restaurante'@'localhost';
  FLUSH PRIVILEGES;

3. Importar la Estructura de la Base de Datos
Método 1 - Línea de comandos:
  mysql -u root -p restaurante < database/restaurante.sql

Método 2 - phpMyAdmin:
  -Selecciona la base de datos restaurante
  -Ve a la pestaña "Importar"
  -Selecciona el archivo restaurante.sql
  -Haz clic en "Ejecutar"

4. Configurar Variables de la Aplicación
Edita el archivo admin/bd.php con tus credenciales:

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

5. Instalar PHPMailer
Descarga manual:
Descarga PHPMailer desde: https://github.com/PHPMailer/PHPMailer
Extrae los archivos en: C:\xampp\htdocs\restaurante\vendor\phpmailer\

Estructura final esperada:

restaurante/
├── vendor/
│   ├── phpmailer/
│   │   ├── src/
│   │   │   ├── PHPMailer.php
│   │   │   ├── Exception.php
│   │   │   └── SMTP.php
│   │   └── ...
├── admin/
│   ├── bd.php
│   └── ...
├── images/
├── restaurante.sql
└── index.php

