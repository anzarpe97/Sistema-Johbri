<?php
require '../logica/conexionbdd.php';
require '../vendor/autoload.php';

use Dompdf\Dompdf;

session_start();

if (!ISSET($_SESSION['id'])) {
    header('location:../login-sesion/login.php?error_message=Por favor inicie sesión');
    exit();
}

// Check if order ID is provided
if (!isset($_GET['id'])) {
    header('location: ../panelCliente/ordenes.php');
    exit();
}

$orden_id = $_GET['id'];

// Fetch order details
$sql_orden = "SELECT o.id_orden, o.fecha_creacion, o.estado, c.nombre_empresa,
                     SUM(d.cantidad * d.precio_unitario) as total
            FROM ordenes o
            INNER JOIN clientes c ON o.cliente_id = c.id
            INNER JOIN detalle_orden d ON o.id_orden = d.id_orden
            WHERE o.id_orden = ?
            GROUP BY o.id_orden";

$stmt = $conn->prepare($sql_orden);
$stmt->bind_param("i", $orden_id);
$stmt->execute();
$result_orden = $stmt->get_result();
$orden = $result_orden->fetch_assoc();

// Fetch order items
$sql_items = "SELECT p.nombre_producto as producto, d.cantidad, d.precio_unitario,
                     (d.cantidad * d.precio_unitario) as subtotal
            FROM detalle_orden d
            INNER JOIN productos p ON d.id_producto = p.id_producto
            WHERE d.id_orden = ?";

$stmt = $conn->prepare($sql_items);
$stmt->bind_param("i", $orden_id);
$stmt->execute();
$result_items = $stmt->get_result();

$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura - Autorepuestos Johbri</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .container { width: 80%; margin: auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        .details, .items { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .details th, .details td, .items th, .items td { border: 1px solid #ddd; padding: 8px; }
        .details th, .items th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Factura</h1>
            <p>Autorepuestos Johbri, C.A.</p>
        </div>
        <table class="details">
            <tr>
                <th>Número de Orden</th>
                <td>ORD-' . str_pad($orden['id_orden'], 4, '0', STR_PAD_LEFT) . '</td>
            </tr>
            <tr>
                <th>Fecha</th>
                <td>' . date('d-m-Y', strtotime($orden['fecha_creacion'])) . '</td>
            </tr>
            <tr>
                <th>Empresa</th>
                <td>' . htmlspecialchars($orden['nombre_empresa']) . '</td>
            </tr>
            <tr>
                <th>Estado</th>
                <td>' . ucfirst($orden['estado']) . '</td>
            </tr>
        </table>
        <table class="items">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>';

while ($item = $result_items->fetch_assoc()) {
    $html .= '
                <tr>
                    <td>' . htmlspecialchars($item['producto']) . '</td>
                    <td>' . $item['cantidad'] . '</td>
                    <td>$' . number_format($item['precio_unitario'], 2) . '</td>
                    <td>$' . number_format($item['subtotal'], 2) . '</td>
                </tr>';
}

$html .= '
                <tr>
                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                    <td>$' . number_format($orden['total'], 2) . '</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('factura_orden_' . $orden_id . '.pdf', array('Attachment' => 0));
?>