<?php
require_once __DIR__ . '/../config.php';

// Si el usuario ya está logueado, lo redirigimos
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $correo_form = $_POST['email'];
    $password = $_POST['password'];

    $query = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE correo = :correo");
    $query->bindParam(':correo', $correo_form);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['user_type'] = $user['tipo'];
        $_SESSION['user_name'] = $user['Nombre'];

        if ($user['tipo'] == 'administrador') {
            header("Location: ../admin/index.php");
        } else {
            header("Location: ../index.php");
        }
        exit();
    } else {
        $login_error = "Correo o contraseña incorrectos. Intente nuevamente.";
    }
}

$pageTitle = "Iniciar Sesión";
include '../templates/header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Iniciar Sesión</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($login_error)): ?>
                        <div class="alert alert-danger"><?php echo $login_error; ?></div>
                    <?php endif; ?>

                    <?php
                    // Mostrar mensaje de éxito si viene del registro
                    if (isset($_SESSION['success_message'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
                        unset($_SESSION['success_message']);
                    }
                    ?>

                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Iniciar Sesión</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>

<?php include '../templates/footer.php'; ?>