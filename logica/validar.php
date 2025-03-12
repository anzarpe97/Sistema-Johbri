<?php

require 'conexionbdd.php';

    function verificarCadena($cadena) {
    
        $patron = "/^[a-zA-Z0-9 .]+$/";

        if (preg_match($patron, $cadena)) {
            return true;
        } else {
            return false;
        }
    }

    function EmailVa($email) {
        
        $patron = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if (preg_match($patron, $email)) {

            return true;  

        } else {

            return false; 

        }
    }

    function verificarContrasena($contrasenaIngresada, $tabla, $correo) {

        $conexion = new mysqli("localhost", "root", "", "repuestos_johbri");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
    
        $sql = "SELECT contrasena, intentos FROM $tabla WHERE correo = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $contrasenaGuardada = $fila['contrasena'];
            $intentos = $fila['intentos'];
    
            if ($intentos >= 3) {

                $error_message = urlencode("El usuario está bloqueado. Contacte al administrador.");
                    header("Location: ../login-sesion/login.php?error_message=" . $error_message);
                    exit();

                return false;
            }
    
            if ($contrasenaIngresada === $contrasenaGuardada) {

                $sqlUpdate = "UPDATE $tabla SET intentos = 0 WHERE correo = ?";
                $stmtUpdate = $conexion->prepare($sqlUpdate);
                $stmtUpdate->bind_param("s", $correo);
                $stmtUpdate->execute();
    
                return true;

            } else {
                // Contraseña incorrecta: incrementar intentos
                $intentos++;
                $sqlUpdate = "UPDATE $tabla SET intentos = ? WHERE correo = ?";
                $stmtUpdate = $conexion->prepare($sqlUpdate);
                $stmtUpdate->bind_param("is", $intentos, $correo);
                $stmtUpdate->execute();
    
                if ($intentos >= 3) {

                    $error_message = urlencode("El usuario ha sido bloqueado.");
                    header("Location: ../login-sesion/login.php?error_message=" . $error_message);
                    exit();

                } else {

                    $error_message = urlencode("Contraseña incorrecta. Intentos restantes: " . (3 - $intentos));
                    header("Location: ../login-sesion/login.php?error_message=" . $error_message);
                    exit();

                }

                return false;
            }
        } else {
            return false;
        }
    
        // Cerrar la conexión
        $stmt->close();
        $conexion->close();
    }

    function validated_password($password) {

        $patron = "/^(?=.*\d)(?=.*[A-Z])(?=.*[^\w\s])(?=.{8,})|(?=.*[_])/";
        if (preg_match($patron, $password)) {
            return true; 
        } else {
            return false; 
        }
    }   

    function obtenerRutasArchivos($id) {
        
        $conn = new mysqli('localhost', 'root', '', 'repuestos_johbri');

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $sql = "SELECT ruta_foto FROM foto_productos WHERE id_producto = $id  LIMIT 1";
        $result = $conn->query($sql);

        $ruta_imagen = "../assets/foto-repuestos/no_foto.jpg";

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ruta_imagen = $row["ruta_foto"];
        }

        $conn->close();
        return $ruta_imagen;
    }

    function validarRIF($codigo) {
    
        $patron = '/^J-\d{8}-\d$/';
        if (preg_match($patron, $codigo)) {
            return true; 
        } else {
            return false; 
        }
    }

    function buscarRIF ($codigo) {
        $host = 'localhost';
        $db = 'repuestos_johbri'; 
        $user = 'root'; 
        $pass = '';

        try {

            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT COUNT(*) FROM clientes WHERE RIF = :codigo";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codigo', $codigo);
            
            $stmt->execute();
            
            $resultado = $stmt->fetchColumn();
            
            return $resultado > 0;

        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return false; // En caso de error, retornar false
        }
    }

    function buscarAdmin($correo, $tabla) {
        $conexion = new mysqli("localhost", "root", "", "repuestos_johbri");
    
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
    
        $sql = "SELECT COUNT(*) as total FROM $tabla WHERE correo = ?";
        $stmt = $conexion->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
    
        if ($fila['total'] > 0) {
            $stmt->close();
            $conexion->close();
            return true;
        } else {
            $stmt->close();
            $conexion->close();
            return false;
        }
    }

    function validar_RIF($codigo) {
        $patron = '/^J-\d{8}-\d$/';
        if (preg_match($patron, $codigo)) {
            return true;
        } else {
            return false;
        }
    }

    function validar_telefono($numero) {

        $patron = '/^(0414|0424|0426|0416|0412)(-?\d{7})$/';

        if (preg_match($patron, $numero)) {
            return true;
        } else {
            return false; 
        }
    }

    function validar_cedula($cadena) {

        $patron = '/^(V|E)-\d{8,9}$/';
        
        if (preg_match($patron, $cadena)) {

            return true; 

        } 
        
        else {

            return false; 

        }
    }

    function buscarNumPart($correo, $tabla) {
        $conexion = new mysqli("localhost", "root", "", "repuestos_johbri");
    
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
    
        $sql = "SELECT COUNT(*) as total FROM $tabla WHERE numero_de_parte = ?";
        $stmt = $conexion->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
    
        if ($fila['total'] > 0) {
            $stmt->close();
            $conexion->close();
            return false;
        } else {
            $stmt->close();
            $conexion->close();
            return true;
        }
    }


?>

