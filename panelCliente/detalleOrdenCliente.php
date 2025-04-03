<?php
require '../logica/conexionbdd.php';
session_start();

if(!ISSET($_SESSION['id'])){
    header('location:../login-sesion/login.php?error_message=Por favor inicie sesión');
    exit();
}

// Check if order ID is provided
if (!isset($_GET['id'])) {
    header('location: ordenes.php');
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
?>

<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="../assets/images/configuraciones.ico">
    <title>Detalle de Orden - Autorepuestos Johbri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'custom-blue': '#2563eb',
                        'custom-blue-light': '#3b82f6'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-custom-blue dark:bg-gray-800 text-white px-6 py-4 fixed w-full top-0 z-50 shadow-lg">
        <div class="flex justify-between items-center">
            <div class="text-xl font-bold">
                <a href="./cliente.php"
                class="text-xl hover:text-gray-200 transition-colors duration-200 flex items-center gap-2 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="text-sm">Volver</span>
                </a>
            </div>
            <div class="flex items-center gap-4">
            <div class="relative group">
                    <button class="flex items-center hover:text-gray-300 transition-colors duration-200">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.75 2.44995C11.45 1.85995 12.58 1.85995 13.26 2.44995L14.84 3.79995C15.14 4.04995 15.71 4.25995 16.11 4.25995H17.81C18.87 4.25995 19.74 5.12995 19.74 6.18995V7.88995C19.74 8.28995 19.95 8.84995 20.2 9.14995L21.55 10.7299C22.14 11.4299 22.14 12.5599 21.55 13.2399L20.2 14.8199C19.95 15.1199 19.74 15.6799 19.74 16.0799V17.7799C19.74 18.8399 18.87 19.7099 17.81 19.7099H16.11C15.71 19.7099 15.15 19.9199 14.85 20.1699L13.27 21.5199C12.57 22.1099 11.44 22.1099 10.76 21.5199L9.18001 20.1699C8.88001 19.9199 8.31 19.7099 7.92 19.7099H6.17C5.11 19.7099 4.24 18.8399 4.24 17.7799V16.0699C4.24 15.6799 4.04 15.1099 3.79 14.8199L2.44 13.2299C1.86 12.5399 1.86 11.4199 2.44 10.7299L3.79 9.13995C4.04 8.83995 4.24 8.27995 4.24 7.88995V6.19995C4.24 5.13995 5.11 4.26995 6.17 4.26995H7.9C8.3 4.26995 8.86 4.05995 9.16 3.80995L10.75 2.44995Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 8.13V12.96" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.9945 16H12.0035" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-1 group-hover:translate-y-0">
                        <a href="../assets/docs/MANUAL DE USUARIO (CLIENTE) (1).pdf" target="_blank" class="block px-4 py-2 text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600 rounded-b-lg">
                            Manual de Usuario Cliente
                        </a>
                    </div>
                </div>
                <button
                    onclick="document.documentElement.classList.toggle('dark')"
                    class="p-2 rounded-full bg-gray-700 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-700 transition-colors duration-200"
                >
                    <span class="dark:hidden">🌙</span>
                    <span class="hidden dark:inline">☀️</span>
                </button>
                <a href="../logica/cerrar-sesion.php" class="hover:underline">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="pt-24 px-6 pb-20">
        <!-- Encabezado -->
        <div class="max-w-7xl mx-auto mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detalle de Orden</h1>
        </div>

        <!-- Detalle de la Orden -->
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Número de Orden:</h2>
                    <p class="text-gray-700 dark:text-gray-300">
                        <?php echo htmlspecialchars('ORD-' . str_pad($orden['id_orden'], 4, '0', STR_PAD_LEFT)); ?>
                    </p>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Fecha:</h2>
                    <p class="text-gray-700 dark:text-gray-300">
                        <?php echo date('d-m-Y', strtotime($orden['fecha_creacion'])); ?>
                    </p>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Empresa:</h2>
                    <p class="text-gray-700 dark:text-gray-300">
                        <?php echo htmlspecialchars($orden['nombre_empresa']); ?>
                    </p>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Estado:</h2>
                    <p class="<?php echo $orden['estado'] == 'pendiente' ? 'text-yellow-800 dark:text-yellow-200' : 'text-green-800 dark:text-green-200'; ?>">
                        <?php echo ucfirst($orden['estado']); ?>
                    </p>
                </div>
            </div>

            <!-- Order Items Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Precio Unitario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <?php while($item = $result_items->fetch_assoc()): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        <?php echo htmlspecialchars($item['producto']); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        <?php echo $item['cantidad']; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        $<?php echo number_format($item['precio_unitario'], 2); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        $<?php echo number_format($item['subtotal'], 2); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <tr class="bg-gray-50 dark:bg-gray-700">
                            <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-900 dark:text-white">Total:</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900 dark:text-white">
                                    $<?php echo number_format($orden['total'], 2); ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Report Button -->
        <div class="max-w-7xl mx-auto mt-6 text-right">
            <form action="../reportes/reporte-compra.php" method="get">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($orden['id_orden']); ?>">
                <button type="submit" class="px-4 py-2 bg-custom-blue text-white rounded-lg hover:bg-custom-blue-light transition-colors duration-200">
                    Generar Factura
                </button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-custom-blue dark:bg-gray-800 text-white text-center py-4 fixed bottom-0 w-full text-sm">
        <p>&copy; 2025 Autorepuestos Johbri, C.A. - Todos los derechos reservados</p>
    </footer>

    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>
