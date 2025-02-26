<?php

require 'conexionbdd.php';	
require 'validar.php';

session_start();
        
if (!isset($_SESSION['id'])) {
    header('Location: ../login-sesion/login.php');
    exit();
}

$flag =true;

$nombre_empresa = $_POST['nombre_empresa'];
$rif = $_POST['rif'];
$telefono_empresa = $_POST['telefono_empresa'];
$direccion = $_POST['direccion'];
$nombre_encargado = $_POST['nombre_encargado'];
$cedula_encargado = $_POST['cedula_encargado'];
$telefono_encargado = $_POST['telefono_encargado'];
$correo_empresa = $_POST['correo_empresa'];
$contraseña = $_POST['contraseña'];


if (!verificarCadena($nombre_empresa)) {
    
    $flag = false;



}








?>