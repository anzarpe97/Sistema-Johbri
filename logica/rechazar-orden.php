<?php
require 'conexionbdd.php';
session_start();

if (!isset($_SESSION['id']) || !isset($_GET['id'])) {
    header('Location: ../panelAdmin/ordenes.php');
    exit();
}

$orden_id = $_GET['id'];
$sql = "UPDATE ordenes SET estado = 'rechazada' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $orden_id);

if ($stmt->execute()) {
    header('Location: ../panelAdmin/ordenes.php?mensaje=Orden rechazada exitosamente');
} else {
    header('Location: ../panelAdmin/ordenes.php?error=Error al rechazar la orden');
}
exit();
?>