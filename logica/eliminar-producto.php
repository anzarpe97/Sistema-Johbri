<?php

include 'conexionbdd.php';
include 'validar.php';

$id = $_GET['id_producto'];
$id_producto = obtenerIdProducto($id);

$sql = "DELETE FROM foto_productos WHERE id_producto = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $id_producto);
    if ($stmt->execute()) {
        
    } else {
        
    }
    $stmt->close();
} else {
    
}

$sql_producto = "DELETE FROM productos WHERE id_producto = ?";

if ($stmt_producto = $conn->prepare($sql_producto)) {
    $stmt_producto->bind_param("i", $id_producto);
    if ($stmt_producto->execute()) {
        header("location: ../panelAdmin/ver-Producto.php?success_message=Producto eliminado correctamente");
        exit();
    } else {
        echo "Error al eliminar el producto: " . $stmt_producto->error;
    }
    $stmt_producto->close();
} else {
    echo "Error al preparar la consulta de producto: " . $conn->error;
}

$conn->close();

?>