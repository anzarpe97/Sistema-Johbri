<?php
require 'conexionbdd.php';
require 'validar.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$flag = true;

$stmt = $conn->prepare("SELECT * FROM administrador WHERE correo_administrador = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$resultado = $stmt->get_result();


    if ($resultado->num_rows > 0) {

        $fila = $resultado->fetch_assoc();

        if ($password == $fila['contrasena_administrador']) { 

            $stmt = $conn->prepare("UPDATE administrador SET intentos = 0 WHERE id_administrador = ?");
            $stmt->bind_param("i",  $fila['id_administrador']); 
            $stmt->execute();

            $_SESSION['id'] = $fila['id_administrador'];
            $id=$fila['id_administrador'];
            header("location: ../panelAdmin/admin.php");
            exit();

        } else {

            $intento = $fila['intentos'] + 1;

            if ($fila['intentos'] < 2){
                $stmt = $conn->prepare("UPDATE administrador SET intentos = ? WHERE id_administrador = ?");
                $stmt->bind_param("ii", $intento, $fila['id_administrador']); 
                $stmt->execute();

                if ($intento == 1){
                    $error_message = urlencode("Usuario o contraseña incorrectos, te quedan ". 3 - $intento ." intentos.");    
                }

                else{
                    $error_message = urlencode("Usuario o contraseña incorrectos, te quedan ". 3 - $intento ." intento.");
                }
            }

            else{
                $error_message = urlencode("Usuario bloqueado, por contacte con el administrador.");
            }

            header("Location: ../login-sesion/login.php?error_message=" . $error_message);
            exit();

        }
    } 
    
    else {
        $error_message = urlencode("Correo no registrado");
        header("Location: ../login-sesion/login.php?error_message=" . $error_message);
        exit();
    }


if (isset($error_message)) {

    echo "<p style='color: red;'>$error_message</p>"; 

}

$stmt->close();
$conn->close();

?>  