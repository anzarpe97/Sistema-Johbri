<?php

require 'conexionbdd.php';

function EmailVa($email) {
    
    $patron = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    if (preg_match($patron, $email)) {

        return true;  

    } else {

        return false; 

    }
}

function validated_password ($password){

    $patron = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){6,16}$/";

    if (preg_match($patron, $password)) {

        return True;

    } 

    else {

        return False;

    }

    return True;
    
}


function obtenerRutasArchivos($id) {
    
    $conn = new mysqli('localhost', 'root', '', 'repuestos_johbri');

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT ruta_foto FROM foto_productos WHERE id_producto = $id  LIMIT 1";
    $result = $conn->query($sql);

    $ruta_imagen = "ruta/a/imagen_por_defecto.jpg"; // Valor por defecto

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ruta_imagen = $row["ruta_foto"];
    }

    $conn->close();
    return $ruta_imagen;
  }

?>