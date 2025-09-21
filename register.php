<?php

$pageTitle = "Inicio - Mi Sitio Web";
include 'templates/header.php';

//Conexión a la base de datos
include 'admin/bd.php';


// Iniciar sesión
session_start();

// Verificar si el usuario ya está logueado
if (isset($_SESSION['user_id'])) {
    $user_type = $_SESSION['user_type'];
    
    // Redirigir según el tipo de usuario
    if ($user_type == 'administrador') {
        header("Location: admin/index.php");
        exit();
    } else {
        header("Location: cliente/index.php");
        exit();
    }
}

// Procesar inicio de sesión
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Buscar usuario en la base de datos
    $query = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE email = :email AND password = :password");
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->execute();
    
    if ($query->rowCount() > 0) {
        $user = $query->fetch(PDO::FETCH_ASSOC);
        
        // Iniciar sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['tipo'];
        $_SESSION['user_name'] = $user['nombre'];
        
        // Redirigir según el tipo de usuario
        if ($user['tipo'] == 'administrador') {
            header("Location: admin/index.php");
        } else {
            header("Location: cliente/index.php");
        }
        exit();
    } else {
        $login_error = "Credenciales incorrectas. Intente nuevamente.";
    }
}

// Procesar registro
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    
    // Verificar si el usuario ya existe
    $query = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();
    
    if ($query->rowCount() > 0) {
        $register_error = "El email ya está registrado.";
    } else {
        // Insertar nuevo usuario
        $query = $conexion->prepare("INSERT INTO tbl_usuarios (nombre, email, password, tipo) VALUES (:nombre, :email, :password, :tipo)");
        $query->bindParam(':nombre', $name);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $password);
        $query->bindParam(':tipo', $user_type);
        
        if ($query->execute()) {
            $register_success = "Usuario registrado correctamente. Ahora puede iniciar sesión.";
        } else {
            $register_error = "Error al registrar el usuario.";
        }
    }
}
?>
<br><br><br><br><br><br>
<section>
    <h1>Restaurante Delicioso</h1>
    <h2>Sistema de Autenticación</h2>

    <div style="display: flex; justify-content: space-around;">
        <!-- Formulario de Inicio de Sesión -->
        <div style="width: 45%; border: 1px solid #ccc; padding: 20px;">
            <h3>Iniciar Sesión</h3>
            <?php if (isset($login_error)): ?>
                <p style="color: red;"><?php echo $login_error; ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <div>
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label>Contraseña:</label>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <button type="submit" name="login">Iniciar Sesión</button>
                </div>
            </form>
        </div>

        <!-- Formulario de Registro -->
        <div style="width: 45%; border: 1px solid #ccc; padding: 20px;">
            <h3>Registrarse</h3>
            <?php if (isset($register_error)): ?>
                <p style="color: red;"><?php echo $register_error; ?></p>
            <?php endif; ?>
            <?php if (isset($register_success)): ?>
                <p style="color: green;"><?php echo $register_success; ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <div>
                    <label>Nombre:</label>
                    <input type="text" name="name" required>
                </div>
                <div>
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label>Contraseña:</label>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <label>Tipo de usuario:</label>
                    <select name="user_type" required>
                        <option value="cliente">Cliente</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>
                <div>
                    <button type="submit" name="register">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
            </section>
            <br><br><br><br><br><br>
            <br><br><br><br><br><br>
        
    <?php
include 'templates/footer.php';

?>