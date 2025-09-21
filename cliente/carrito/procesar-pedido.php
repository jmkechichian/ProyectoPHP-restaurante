<?php
require_once '../../config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

if (!isset($_SESSION['user_id']) || empty($_SESSION['carrito'])) {
    header("Location: index.php");
    exit();
}

$sentencia = $conexion->prepare("SELECT Nombre, correo FROM tbl_usuarios WHERE ID = :id");
$sentencia->bindParam(':id', $_SESSION['user_id']);
$sentencia->execute();
$usuario = $sentencia->fetch(PDO::FETCH_ASSOC);

// --- Construcción del cuerpo del correo ---
$total = 0;
$cuerpoCorreo = "<h1>Gracias por tu pedido, " . htmlspecialchars($usuario['Nombre']) . "!</h1>";
$cuerpoCorreo .= "<p>Aqui esta el detalle de tu compra:</p>";
$cuerpoCorreo .= "<table border='1' cellpadding='10' cellspacing='0'>
                    <thead style='background-color: #f2f2f2;'>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>";

foreach ($_SESSION['carrito'] as $producto) {
    $subtotal = $producto['precio'] * $producto['cantidad'];
    $total += $subtotal;
    $cuerpoCorreo .= "<tr>
                        <td>" . htmlspecialchars($producto['nombre']) . "</td>
                        <td>" . $producto['cantidad'] . "</td>
                        <td>$" . number_format($producto['precio'], 2) . "</td>
                        <td>$" . number_format($subtotal, 2) . "</td>
                      </tr>";
}
$cuerpoCorreo .= "</tbody>
                  <tfoot>
                    <tr>
                        <td colspan='3' style='text-align: right;'><strong>Total:</strong></td>
                        <td><strong>$" . number_format($total, 2) . "</strong></td>
                    </tr>
                  </tfoot>
                </table>";
$cuerpoCorreo .= "<p>Esperamos que disfrutes tu comida!</p>";

// --- Guardar el pedido en la base de datos ---
try {
    $conexion->beginTransaction();

    $sentencia_pedido = $conexion->prepare("INSERT INTO tbl_pedidos (ID_usuario, total) VALUES (:id_usuario, :total)");
    $sentencia_pedido->bindParam(':id_usuario', $_SESSION['user_id']);
    $sentencia_pedido->bindParam(':total', $total);
    $sentencia_pedido->execute();

    $id_pedido = $conexion->lastInsertId();

    foreach ($_SESSION['carrito'] as $id_menu => $producto) {
        $sentencia_detalle = $conexion->prepare(
            "INSERT INTO tbl_detalle_pedidos (ID_pedido, ID_menu, precio_unitario, cantidad) 
             VALUES (:id_pedido, :id_menu, :precio, :cantidad)"
        );
        $sentencia_detalle->bindParam(':id_pedido', $id_pedido);
        $sentencia_detalle->bindParam(':id_menu', $id_menu);
        $sentencia_detalle->bindParam(':precio', $producto['precio']);
        $sentencia_detalle->bindParam(':cantidad', $producto['cantidad']);
        $sentencia_detalle->execute();
    }
    $conexion->commit();
} catch (Exception $e) {
    $conexion->rollBack();
    echo "Fallo al guardar el pedido: " . $e->getMessage();
    exit();
}

// --- Configuración y envío con PHPMailer ---
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'restaurantejfm@gmail.com';
    $mail->Password   = 'xpzifwhgqkueurvj';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Remitente y destinatarios
    $mail->setFrom('restaurantejfm@gmail.com', 'Restaurante JFM');
    $mail->addAddress($usuario['correo'], $usuario['Nombre']);

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Confirmacion de tu pedido en Restaurante JFM';
    $mail->Body    = $cuerpoCorreo;
    $mail->AltBody = 'Gracias por tu pedido. El total es $' . number_format($total, 2);

    $mail->send();

    // Si el correo se envía con éxito, vaciamos el carrito
    unset($_SESSION['carrito']);

    // Guardamos el email en la sesión para mostrarlo en la página de confirmación
    $_SESSION['email_pedido'] = $usuario['correo'];

    // Redirigimos a la página de confirmación
    header('Location: confirmacion.php');
    exit();
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
}
