<?php

session_start();
if (!isset($_SESSION['id'])) {
    header('location:../login-sesion/login.php?error_message=Por favor inicie sesión');
    exit();
} else {
    if ((time() - $_SESSION['time']) > 600) {
        session_unset();
        session_destroy();
        header('location:../login-sesion/login.php?error_message=La sesión ha expirado');
        exit();
    }
}

$_SESSION['time'] = time();

require '../logica/conexionbdd.php';

if (isset($_GET['numero_de_parte'])) {
    $numero_de_parte = $_GET['numero_de_parte'];

    $_SESSION['e_num_part'] = $numero_de_parte;
    
    $stmt = $conn->prepare("SELECT * FROM productos WHERE numero_de_parte = ?");
    $stmt->bind_param("s", $numero_de_parte);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit();
    }
} else {
    echo "Número de parte no proporcionado.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Autorepuestos Johbri</title>
    <link rel="icon" type="image/ico" href="../assets/images/configuraciones.ico">
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
                <a href="ver-Producto.php"
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
                        <a href="assets/docs/MANUAL DE USUARIO (ADMIN) (1).pdf" target="_blank" class="block px-4 py-2 text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600 rounded-t-lg">
                            Manual de Usuario Admin
                        </a>
                        <a href="assets/docs/MANUAL DE USUARIO (CLIENTE) (1).pdf" target="_blank" class="block px-4 py-2 text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600 rounded-b-lg">
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

        <div class="max-w-4xl mx-auto">

            <div id="errorAlert" class="hidden ml-3 flex justify-between items-center bg-red-100 dark:bg-red-700 p-4 rounded">
                <p class="text-sm text-red-500 dark:text-red-100">
                    <?php
                    if (isset($_GET['error_message'])) {
                        echo urldecode($_GET['error_message']);
                    }
                    ?>
                </p>
                <button onclick="document.getElementById('errorAlert').classList.add('hidden')" class="text-red-500 dark:text-red-400">
                    &times;
                </button>
        </div>
            <br>
            <!-- Encabezado -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Editar Producto</h1>
                <p class="text-gray-600 dark:text-gray-400">Modifica los detalles del producto según sea necesario</p>
            </div>

            <!-- Formulario -->
            <form action="../logica/actualizar-producto.php" method="POST" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <!-- Información básica -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Número de parte -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Número de parte
                            </label>
                            <input type="text" name="numero_de_parte_campo"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"
                                value="<?php echo $producto['numero_de_parte']; ?>">
                        </div>

                        <!-- Nombre del producto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nombre del producto
                            </label>
                            <input type="text" name="nombre_producto"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"
                                value="<?php echo $producto['nombre_producto']; ?>">
                        </div>

                        <!-- Precio -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Precio ($)
                            </label>
                            <input type="number" name="precio_producto"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"
                                value="<?php echo $producto['precio_producto']; ?>" step="0.01">
                        </div>

                        <!-- Categoría -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Categoría
                            </label>
                            <select name="categoria_producto" class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                                <option <?php if ($producto['categoria_producto'] == 'Frenos') echo 'selected'; ?>>Frenos</option>
                                <option <?php if ($producto['categoria_producto'] == 'Suspensión') echo 'selected'; ?>>Suspensión</option>
                                <option <?php if ($producto['categoria_producto'] == 'Motor') echo 'selected'; ?>>Motor</option>
                                <option <?php if ($producto['categoria_producto'] == 'Transmisión') echo 'selected'; ?>>Transmisión</option>
                                <option <?php if ($producto['categoria_producto'] == 'Electricidad') echo 'selected'; ?>>Electricidad</option>
                                <option <?php if ($producto['categoria_producto'] == 'Carrocería') echo 'selected'; ?>>Carrocería</option>
                            </select>
                        </div>

                        <!-- Marca -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Marca
                            </label>
                            <select name="marca_producto" class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                                <option <?php if ($producto['marca_producto'] == 'Toyota') echo 'selected'; ?>>Toyota</option>
                                <option <?php if ($producto['marca_producto'] == 'Honda') echo 'selected'; ?>>Honda</option>
                                <option <?php if ($producto['marca_producto'] == 'Chevrolet') echo 'selected'; ?>>Chevrolet</option>
                                <option <?php if ($producto['marca_producto'] == 'Ford') echo 'selected'; ?>>Ford</option>
                                <option <?php if ($producto['marca_producto'] == 'Nissan') echo 'selected'; ?>>Nissan</option>
                            </select>
                        </div>

                        <!-- Stock -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Stock disponible
                            </label>
                            <input type="number" name="stock_producto"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"
                                value="<?php echo $producto['stock_producto']; ?>">
                        </div>

                    </div>

                    <!-- Descripción -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Descripción del producto
                        </label>
                        <textarea name="descripcion_producto"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"
                            rows="4"><?php echo $producto['descripcion_producto']; ?></textarea>
                    </div>

                </div>

                <!-- Botones de acción -->
                <div class="mt-6 flex justify-end space-x-4">
                    <button type="button" 
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 dark:text-gray-300
                            hover:bg-gray-50 dark:hover:bg-gray-700">
                        Cancelar
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 bg-custom-blue hover:bg-custom-blue-light text-white rounded-md
                            transition-colors duration-200">
                        Guardar Cambios
                    </button>
                </div>
                <input type="hidden" name="numero_de_parte" value="<?php echo $producto['numero_de_parte']; ?>">
            </form>
        </div>
    </main>

    <footer class="bg-custom-blue dark:bg-gray-800 text-white text-center py-4 fixed bottom-0 w-full text-sm">
        <p>&copy; 2025 Autorepuestos Johbri, C.A. - Todos los derechos reservados</p>
    </footer>

    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }

        document.addEventListener('DOMContentLoaded', function() {

            const errorMessage = "<?php echo isset($_GET['error_message']) ? urldecode($_GET['error_message']) : ''; ?>";
            
            if (errorMessage) {
                document.getElementById('errorAlert').classList.remove('hidden');
            }

        });
    </script>
</body>
</html>