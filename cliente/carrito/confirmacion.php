<?php
$pageTitle = "Pedido Confirmado";
include '../../templates/header.php';

if (!isset($_SESSION['email_pedido'])) {
    header("Location: index.php");
    exit();
}
?>

<div class="container mt-5 text-center">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">¡Gracias por tu compra! 🎉</h4>
        <p>Tu pedido ha sido procesado exitosamente.</p>
        <hr>
        <p class="mb-0">Hemos enviado un correo con el detalle de tu compra a: <strong><?php echo htmlspecialchars($_SESSION['email_pedido']); ?></strong></p>
    </div>
    <a href="../../index.php" class="btn btn-primary mt-3">Volver a la Página Principal</a>
</div>
<br><br>
<?php

unset($_SESSION['email_pedido']);
include '../../templates/footer.php';
?>