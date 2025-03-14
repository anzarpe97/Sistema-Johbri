<?php
require '../vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $email = $_GET['email'];
    $cliente = obtenerCliente($email); // Implementa esta función para obtener los datos del cliente

    if ($cliente) {
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = 'live.smtp.mailtrap.io'; // Servidor SMTP de Mailtrap
            $mail->SMTPAuth = true;
            $mail->Username = 'api'; // Cambia esto por tu usuario de Mailtrap
            $mail->Password = 'de82e528e668d0da2a5b1720ee952fcc'; // Cambia esto por tu contraseña de Mailtrap
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinatarios
            $mail->setFrom('no-reply-johbri@johbri.com', 'Tu Nombre'); // Cambia esto por tu correo y nombre
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body    = 'Hola ' . $cliente['nombre'] . ',<br>Tu solicitud de recuperación de contraseña ha sido recibida.';

            $mail->send();
            echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Error de Mailer: {$mail->ErrorInfo}";
        }
    } else {
        echo 'No se encontró el cliente para el correo proporcionado';
    }
}

function obtenerCliente($email) {
   $conn = new mysqli('locahost', 'root', '', 'repuestos_johbri');
    if ($conn->connect_error) {
        die('Error en la conexión: ' . $conn->connect_error);
    }
   $result = $conn->query("SELECT nombre_encargado, correo FROM clientes WHERE correo = '$email'");
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
     }
     return null;
}
?>