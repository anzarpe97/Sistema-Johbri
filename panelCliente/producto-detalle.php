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

// Obtener el ID del producto
$id_producto = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id_producto)) {
    header('location: catalogo.php');
    exit();
}

// Consultar los detalles del producto
$stmt = $conn->prepare("SELECT * FROM productos WHERE id_producto = ?");
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

if (!$producto) {
    header('location: catalogo.php');
    exit();
}

// Obtener la ruta de la imagen
$foto_producto = obtenerRutasArchivos($producto['id_producto']);
?>
<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($producto['nombre_producto']); ?> - Autorepuestos Johbri, C.A.</title>
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
            <a href="catalogo.php" class="text-xl hover:text-gray-200 transition-colors duration-200 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="text-sm">Volver</span>
            </a>
            <div class="text-xl font-bold">Autorepuestos Johbri, C.A.</div>
            <div class="flex items-center gap-4">
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
    <main class="pt-24 px-6 pb-20 max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 text-sm mb-6">
            <a href="catalogo.php" class="text-custom-blue dark:text-blue-400 hover:underline">Catálogo</a>
            <span class="text-gray-500 dark:text-gray-400">/</span>
            <span class="text-gray-600 dark:text-gray-300"><?php echo htmlspecialchars($producto['nombre_producto']); ?></span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Imagen Principal -->
            <div class="space-y-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                    <img src="<?php echo $foto_producto; ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" class="w-full h-96 object-contain">
                </div>
            </div>

            <!-- Información del Producto -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white"><?php echo $producto['nombre_producto']; ?></h1>
                        <p class="text-3xl font-bold text-custom-blue dark:text-blue-400 mt-2">$<?php echo number_format($producto['precio_producto'], 2); ?></p>
                    </div>
                    <?php if ($producto['stock_producto'] > 0): ?>
                    <button onclick="addToCart(<?php echo $producto['id_producto']; ?>)"
                        class="inline-block bg-custom-blue hover:bg-custom-blue-light dark:bg-blue-600 dark:hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-colors duration-200">
                        Agregar al Carrito
                    </button>
                    <?php endif; ?>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Descripción</h2>
                    <p class="text-gray-600 dark:text-gray-300"><?php echo nl2br(htmlspecialchars($producto['descripcion_producto'])); ?></p>
                </div>

                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php echo $producto['stock_producto'] > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'; ?>">
                        <?php
                        if ($producto['stock_producto'] > 10) {
                            echo "En Stock";
                        } elseif ($producto['stock_producto'] > 0) {
                            echo "Poco Stock";
                        }
                        ?>
                    </span>
                </div>

                <?php if ($producto['stock_producto'] > 0): ?>
                <div class="flex items-center gap-4">
                    <label for="quantity" class="text-gray-700 dark:text-gray-300">Cantidad:</label>
                    <div class="flex items-center">
                        <button onclick="updateQuantity(-1)"
                            class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-3 py-1 rounded-l-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                            -
                        </button>
                        <input type="number" id="quantity" value="1" min="1" max="<?php echo $producto['stock_producto']; ?>"
                            class="w-16 text-center border-y border-gray-200 dark:border-gray-700 py-1 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300"
                            onchange="validateQuantity(this, <?php echo $producto['stock_producto']; ?>)">
                        <button onclick="updateQuantity(1)"
                            class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-3 py-1 rounded-r-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                            +
                        </button>
                    </div>
                </div>
                <?php endif; ?>

                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white">Código</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($producto['numero_de_parte']); ?></p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white">Marca</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($producto['marca_producto']); ?></p>
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

        function updateQuantity(change) {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value) + change;
            input.value = value;
            validateQuantity(input, <?php echo $producto['stock_producto']; ?>);
        }

        function validateQuantity(input, maxStock) {
            let value = parseInt(input.value);
            if (isNaN(value) || value < 1) value = 1;
            if (value > maxStock) value = maxStock;
            input.value = value;
        }

        function addToCart(productId) {
            const quantity = document.getElementById('quantity').value;
            fetch('../logica/cart-handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=add&product_id=${productId}&quantity=${quantity}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mostrar mensaje de éxito
                    alert('Producto agregado al carrito');
                    // Opcional: redirigir al carrito
                    window.location.href = 'carrito.php';
                } else {
                    alert('Error al agregar al carrito');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al agregar al carrito');
            });
        }
    </script>
</body>
</html>