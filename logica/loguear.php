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
        exit();

    } else {
        
        $error_message = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
        header("Location: index.php?error_message=" . urlencode($error_message));
        exit();
exit();
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