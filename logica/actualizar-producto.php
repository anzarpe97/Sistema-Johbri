<?php

require 'conexionbdd.php';
require 'validar.php';

session_start();

$numero_de_parte = $_POST['numero_de_parte_campo'];
$nombre_producto = $_POST['nombre_producto'];
$precio_producto = $_POST['precio_producto'];
$categoria_producto = $_POST['categoria_producto'];
$marca_producto = $_POST['marca_producto'];
$stock_producto = $_POST['stock_producto'];
$descripcion_producto = $_POST['descripcion_producto'];

//verificar si los campos no estan vacios
// Verificar si los campos no están vacíos
if (empty($nombre_producto)) {
    $error_message = urlencode("El Campo producto no puede estar vacio.");
    header("Location: ../panelAdmin/editarProducto.php?numero_de_parte=" . $_SESSION['e_num_part'] . "&error_message=" . $error_message);
    exit();
}

if (empty($precio_producto)) {
    $error_message_editar = urlencode("El Campo precio no puede estar vacio.");
    header("Location: ../panelAdmin/editarProducto.php?numero_de_parte=" . $_SESSION['e_num_part'] . "&error_message_editar=" . $error_message_editar);
    exit();
}

if (empty($categoria_producto)) {
    $error_message_editar = urlencode("El Campo categoria no puede estar vacio.");
    header("Location: ../panelAdmin/editarProducto.php?numero_de_parte=" . $_SESSION['e_num_part'] . "&error_message_editar=" . $error_message_editar);
    exit();
}

if (empty($marca_producto)) {
    $error_message_editar = urlencode("El Campo marca no puede estar vacio.");
    header("Location: ../panelAdmin/editarProducto.php?numero_de_parte=" . $_SESSION['e_num_part'] . "&error_message_editar=" . $error_message_editar);
    exit();
}

if (empty($stock_producto)) {
    $error_message_editar = urlencode("El Campo stock no puede estar vacio.");
    header("Location: ../panelAdmin/editarProducto.php?numero_de_parte=" . $_SESSION['e_num_part'] . "&error_message_editar=" . $error_message_editar);
    exit();
}

if (empty($descripcion_producto)) {
    $error_message_editar = urlencode("El Campo descripcion no puede estar vacio.");
    header("Location: ../panelAdmin/editarProducto.php?numero_de_parte=" . $_SESSION['e_num_part'] . "&error_message_editar=" . $error_message_editar);
    exit();
}


//verificar si el numero de parte ya existe
if ($numero_de_parte != $_SESSION['e_num_part']) {

    if (!buscarNumPart($numero_de_parte, 'productos')) {

        $error_message_editar = urlencode("El numero de parte ya existe.");
        header("Location: ../panelAdmin/editarProducto.php?numero_de_parte=" . $_SESSION['e_num_part'] . "&error_message_editar=" . $error_message_editar);
        exit();

    }
}

// if (!is_numeric($precio_producto) || !is_numeric($stock_producto)) {
//     $error_message_editar = urlencode("El precio y el stock deben ser numericos.");
//     header("Location: ../panelAdmin/editarProducto.php?numero_de_parte=" . $numero_de_parte . "&error_message_editar=" . $error_message_editar);
//     exit();
// }   

// conexion a la base de datos

?>