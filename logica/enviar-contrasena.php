<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'johbrirepuestos@gmail.com';
    $mail->Password = 'sdvw pmjg pnjm igpm';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('no-reply@johbri.com', 'admin');
    $mail->addAddress('anders011097@gmail.com', 'Anderson Salazar');

    $mail->isHTML(true);
    $mail->Subject = 'Recuperacion de Contrasena';
    
    // HTML body
    $mail->Body = '
    <html>
    <head>
        <style>
            .container {
                font-family: Arial, sans-serif;
                margin: 20px;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                background-color: #f9f9f9;
            }
            .header {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 20px;
            }
            .content {
                font-size: 16px;
                line-height: 1.5;
            }
            .footer {
                margin-top: 20px;
                font-size: 12px;
                color: #777;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">Recuperación de Contraseña</div>
            <div class="content">
                <p>Hola Anderson Salazar,</p>
                <p>Hemos recibido una solicitud para restablecer tu contraseña. Si no realizaste esta solicitud, por favor ignora este correo.</p>
                <p>De lo contrario, puedes restablecer tu contraseña haciendo clic en el siguiente enlace:</p>
                <p><a href="https://example.com/reset-password?token=your_token_here">Restablecer Contraseña</a></p>
            </div>
            <div class="footer">
                <p>Este es un mensaje automático, por favor no respondas a este correo.</p>
                <p>&copy; 2025 Johbri Repuestos</p>
            </div>
        </div>
    </body>
    </html>';

    // Plain text body
    $mail->AltBody = 'Hola Anderson Salazar, Hemos recibido una solicitud para restablecer tu contraseña. Si no realizaste esta solicitud, por favor ignora este correo. De lo contrario, puedes restablecer tu contraseña haciendo clic en el siguiente enlace: https://example.com/reset-password?token=your_token_here';

    $mail->send();
    echo 'El mensaje se ha enviado correctamente';
} catch (Exception $e) {
    echo "No se pudo enviar el mensaje. Error: {$mail->ErrorInfo}";
}
?>