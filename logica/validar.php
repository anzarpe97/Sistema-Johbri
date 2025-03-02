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

    function validated_password($password) {

        $patron = "/^(?=.*\d)(?=.*[A-Z])(?=.*[^\w\s])(?=.{8,})|(?=.*[_])/";
        if (preg_match($patron, $password)) {
            echo "holanda";
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
    

?>