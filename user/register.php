<?php
require_once __DIR__ . '/../config.php';

// Si el usuario ya está logueado, lo redirigimos
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['register'])) {
    $nombre = $_POST['name'];
    $correo_form = $_POST['email'];
    $password = $_POST['password'];
    $tipo = $_POST['user_type'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE correo = :correo");
    $query->bindParam(':correo', $correo_form);
    $query->execute();

    if ($query->rowCount() > 0) {
        $register_error = "El correo electrónico ya está registrado.";
    } else {
        $query = $conexion->prepare("INSERT INTO tbl_usuarios (nombre, correo, password, tipo) VALUES (:nombre, :correo, :password, :tipo)");
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':correo', $correo_form);
        $query->bindParam(':password', $hashed_password);
        $query->bindParam(':tipo', $tipo);

        if ($query->execute()) {
            $_SESSION['success_message'] = "¡Registro exitoso! Ahora puedes iniciar sesión.";
            header("Location: login.php");
            exit();
        } else {
            $register_error = "Error al registrar el usuario. Inténtalo de nuevo.";
        }
    }
}

$pageTitle = "Registro de Usuario";
include '../templates/header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Registrarse</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($register_error)): ?>
                        <div class="alert alert-danger"><?php echo $register_error; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="register.php">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_type" class="form-label">Tipo de usuario:</label>
                            <select name="user_type" id="user_type" class="form-select" required>
                                <option value="cliente">Cliente</option>
                                <option value="administrador">Administrador</option>
                            </select>
                        </div>
                        <button type="submit" name="register" class="btn btn-primary w-100">Registrarse</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>

<?php include '../templates/footer.php'; ?>