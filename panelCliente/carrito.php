<?php

require '../logica/validar.php';
require '../logica/conexionbdd.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('location:../login-sesion/loginCliente.php?error_message=Por favor inicie sesión');
    exit();
} else {
    if ((time() - $_SESSION['time']) > 600) {
        session_unset();
        session_destroy();
        header('location:../login-sesion/loginCliente.php?error_message=La sesión ha expirado');
        exit();
    }
}

$_SESSION['time'] = time();

$client_id = $_SESSION['id'];
$query = "SELECT nombre_empresa, nombre_encargado, rif FROM clientes WHERE id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();
$client_data = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Autorepuestos Johbri</title>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="text-sm">Volver</span>
                </a>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm bg-blue-900 px-3 py-1 rounded-full">Bienvenido, <?php echo htmlspecialchars($client_data['nombre_encargado']); ?></span>
                <button
                    onclick="document.documentElement.classList.toggle('dark')"
                    class="p-2 rounded-full bg-gray-700 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-700 transition-colors duration-200">
                    <span class="dark:hidden">🌙</span>
                    <span class="hidden dark:inline">☀️</span>
                </button>
                <a href="../logica/cerrar-sesion.php" class="hover:underline">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="pt-24 px-6 pb-20">
        <h2 class="text-2xl font-bold mb-6 dark:text-white">Carrito de Compras</h2>
        <div class="flex gap-6">
            <!-- Productos en el carrito -->
            <div class="flex-grow">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
                    <!-- Producto en carrito -->
                    <div class="flex items-center border-b dark:border-gray-700 pb-4 mb-4">
                        <img src="../assets/placeholder.jpg" alt="Repuesto" class="w-24 h-24 object-cover rounded-lg">
                        <div class="ml-4 flex-grow">
                            <h3 class="text-lg font-semibold dark:text-white">Filtro de Aceite Original Toyota</h3>
                            <p class="text-gray-600 dark:text-gray-400">Código: TOY-15613-YZZAZ</p>
                            <div class="flex items-center mt-2">
                                <div class="flex items-center border rounded-lg dark:border-gray-600">
                                    <button class="px-3 py-1 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700" onclick="updateQuantity(this, -1)">-</button>
                                    <input type="text" value="1" class="w-12 text-center border-x dark:border-gray-600 bg-transparent dark:text-white" readonly>
                                    <button class="px-3 py-1 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700" onclick="updateQuantity(this, 1)">+</button>
                                </div>
                                <button class="ml-4 text-red-600 hover:text-red-800 dark:hover:text-red-400">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-semibold dark:text-white">$45.99</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">En stock</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumen y productos recomendados -->
            <div class="w-80">
                <!-- Resumen del carrito -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 dark:text-white">Resumen del pedido</h3>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal (2 items)</span>
                            <span class="font-semibold dark:text-white">$135.98</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">IVA (16%)</span>
                            <span class="font-semibold dark:text-white">$21.76</span>
                        </div>
                    </div>
                    <div class="border-t dark:border-gray-700 pt-4 mb-4">
                        <div class="flex justify-between">
                            <span class="font-semibold dark:text-white">Total</span>
                            <span class="font-semibold text-lg dark:text-white">$157.74</span>
                        </div>
                    </div>
                    <button class="w-full bg-custom-blue hover:bg-custom-blue-light text-white py-2 px-4 rounded-lg transition-colors">
                        Proceder al pago
                    </button>
                </div>

                <!-- Productos recomendados -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 dark:text-white">Productos recomendados</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <img src="../assets/placeholder.jpg" alt="Repuesto recomendado" class="w-16 h-16 object-cover rounded">
                            <div class="ml-3">
                                <h4 class="font-medium dark:text-white">Bujías NGK Iridium</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">$12.99/unidad</p>
                                <button class="text-sm text-custom-blue hover:text-custom-blue-light">Agregar al carrito</button>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <img src="../assets/placeholder.jpg" alt="Repuesto recomendado" class="w-16 h-16 object-cover rounded">
                            <div class="ml-3">
                                <h4 class="font-medium dark:text-white">Aceite Mobil 5W-30</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">$35.99</p>
                                <button class="text-sm text-custom-blue hover:text-custom-blue-light">Agregar al carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-custom-blue dark:bg-gray-800 text-white text-center py-4 fixed bottom-0 w-full text-sm">
        <p>&copy; 2025 Autorepuestos Johbri, C.A. - Todos los derechos reservados</p>
    </footer>

    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }

        function updateQuantity(button, change) {
            const input = button.parentElement.querySelector('input');
            let value = parseInt(input.value) + change;
            if (value < 1) value = 1;
            if (value > 99) value = 99;
            input.value = value;
        }
    </script>
</body>

</html>