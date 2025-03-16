<?php
require '../logica/conexionbdd.php';
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Configurar DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Datos de la factura (puedes obtener estos datos de tu base de datos)
$factura = [
    'numero' => '12345',
    'fecha' => '2025-03-15',
    'cliente' => 'Juan Pérez',
    'direccion' => 'Calle Falsa 123, Ciudad, País',
    'productos' => [
        ['descripcion' => 'Producto 1', 'cantidad' => 2, 'precio' => 10.00],
        ['descripcion' => 'Producto 2', 'cantidad' => 1, 'precio' => 20.00],
        ['descripcion' => 'Producto 3', 'cantidad' => 3, 'precio' => 15.00],
    ],
];

// Calcular el total y el IVA
$total = 0;
foreach ($factura['productos'] as $producto) {
    $total += $producto['precio'] * $producto['cantidad'];
}
$iva = $total * 0.16;
$total_con_iva = $total + $iva;

// HTML de la factura
$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
        .invoice-box table { width: 100%; line-height: inherit; text-align: left; }
        .invoice-box table td { padding: 5px; vertical-align: top; }
        .invoice-box table tr td:nth-child(2) { text-align: right; }
        .invoice-box table tr.top table td { padding-bottom: 20px; }
        .invoice-box table tr.information table td { padding-bottom: 40px; }
        .invoice-box table tr.heading td { background: #eee; border-bottom: 1px solid #ddd; font-weight: bold; }
        .invoice-box table tr.details td { padding-bottom: 20px; }
        .invoice-box table tr.item td { border-bottom: 1px solid #eee; }
        .invoice-box table tr.item.last td { border-bottom: none; }
        .invoice-box table tr.total td:nth-child(2) { border-top: 2px solid #eee; font-weight: bold; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h2>Factura</h2>
                            </td>
                            <td>
                                Número de Factura: ' . $factura['numero'] . '<br>
                                Fecha: ' . $factura['fecha'] . '
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                ' . $factura['cliente'] . '<br>
                                ' . $factura['direccion'] . '
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Descripción</td>
                <td>Precio</td>
            </tr>';

foreach ($factura['productos'] as $producto) {
    $html .= '
            <tr class="item">
                <td>' . $producto['descripcion'] . ' (x' . $producto['cantidad'] . ')</td>
                <td>$' . number_format($producto['precio'] * $producto['cantidad'], 2) . '</td>
            </tr>';
}

$html .= '
            <tr class="total">
                <td></td>
                <td>Subtotal: $' . number_format($total, 2) . '</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>IVA (16%): $' . number_format($iva, 2) . '</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>Total: $' . number_format($total_con_iva, 2) . '</td>
            </tr>
        </table>
    </div>
</body>
</html>';

// Cargar el HTML en DOMPDF
$dompdf->loadHtml($html);

// (Opcional) Configurar el tamaño del papel y la orientación
$dompdf->setPaper('A4', 'portrait');

// Renderizar el HTML como PDF
$dompdf->render();

// Enviar el PDF generado al navegador
$dompdf->stream("factura_" . $factura['numero'] . ".pdf", ["Attachment" => false]);

?>  