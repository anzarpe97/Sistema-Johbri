<?php
require_once 'conexionbdd.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];


$stmt = $conn->prepare("SELECT * FROM administrador WHERE correo_administrador = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    
    $fila = $resultado->fetch_assoc();

    if ($password == $fila['contrasena_administrador']) { 

        $_SESSION['id'] = $fila['id_administrador'];

        header("location: ../panelAdmin/admin.php");

    } else {
        
        $error_message = "Contraseña incorrecta.";
    }
} else {

    $error_message = "Usuario no encontrado.";
}


if (isset($error_message)) {

    echo "<p style='color: red;'>$error_message</p>"; 

}

$stmt->close();
$conn->close();

?>  