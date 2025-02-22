<?php
require("conexionbdd.php");

session_start();

$stmt = $conn->prepare("INSERT INTO productos( numero_de_parte, nombre_producto, categoria_producto, marca_producto, precio_producto, stock_producto, descripcion_producto) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("ssssiis",  $_POST['num_parte'], $_POST['nombre_producto'], $_POST['categoria'], $_POST['marca'], $_POST['precio'], $_POST['stock'], $_POST['descripcion']); 
$stmt->execute();




?>

