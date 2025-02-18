<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - Panel de Administración</title>
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
    <style>
        /* Ocultar flechas de incremento/decremento en campos numéricos */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-custom-blue dark:bg-gray-800 text-white px-6 py-4 fixed w-full top-0 z-50 shadow-lg">
        <div class="flex justify-between items-center">
            <div class="text-xl font-bold">Panel de Administración</div>
            <div class="flex items-center gap-4">
                <span class="text-sm bg-green-500 px-2 py-1 rounded-full">Administrador</span>
                <button
                    onclick="document.documentElement.classList.toggle('dark')"
                    class="p-2 rounded-full bg-gray-700 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-700 transition-colors duration-200"
                >
                    <span class="dark:hidden">🌙</span>
                    <span class="hidden dark:inline">☀️</span>
                </button>
                <a href="../login-sesion/login.php" class="hover:underline">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="pt-24 px-6 pb-20 max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 text-sm mb-6">
            <a href="admin.php" class="text-custom-blue dark:text-blue-400 hover:underline">Panel</a>
            <span class="text-gray-500 dark:text-gray-400">/</span>
            <span class="text-gray-600 dark:text-gray-300">Agregar Producto</span>
        </div>

        <!-- Formulario -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Agregar Nuevo Producto</h2>

            <form id="productoForm" class="space-y-6" onsubmit="return handleSubmit(event)">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Información Básica -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nombre del Producto
                            </label>
                            <input
                                type="text"
                                required
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Precio ($)
                            </label>
                            <input
                                type="number"
                                step="0.01"
                                required
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Stock Inicial
                            </label>
                            <input
                                type="number"
                                required
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-white"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Categoría
                            </label>
                            <select
                                required
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">Seleccionar categoría</option>
                                <option>Frenos</option>
                                <option>Suspensión</option>
                                <option>Motor</option>
                                <option>Transmisión</option>
                                <option>Electricidad</option>
                                <option>Carrocería</option>
                            </select>
                        </div>
                    </div>

                    <!-- Imágenes -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Imágenes del Producto
                            </label>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="relative">
                                    <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700">
                                        <img id="preview1" class="w-full h-full object-cover hidden">
                                        <div id="placeholder1" class="w-full h-full flex items-center justify-center">
                                            <span class="text-gray-400">Imagen 1</span>
                                        </div>
                                    </div>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        onchange="previewImage(this, 1)"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    >
                                </div>
                                <div class="relative">
                                    <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700">
                                        <img id="preview2" class="w-full h-full object-cover hidden">
                                        <div id="placeholder2" class="w-full h-full flex items-center justify-center">
                                            <span class="text-gray-400">Imagen 2</span>
                                        </div>
                                    </div>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        onchange="previewImage(this, 2)"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    >
                                </div>
                                <div class="relative">
                                    <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700">
                                        <img id="preview3" class="w-full h-full object-cover hidden">
                                        <div id="placeholder3" class="w-full h-full flex items-center justify-center">
                                            <span class="text-gray-400">Imagen 3</span>
                                        </div>
                                    </div>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        onchange="previewImage(this, 3)"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    >
                                </div>
                                <div class="relative">
                                    <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700">
                                        <img id="preview4" class="w-full h-full object-cover hidden">
                                        <div id="placeholder4" class="w-full h-full flex items-center justify-center">
                                            <span class="text-gray-400">Imagen 4</span>
                                        </div>
                                    </div>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        onchange="previewImage(this, 4)"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vehículos Compatibles -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Vehículos Compatibles
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <input
                                list="marcas"
                                placeholder="Seleccione o escriba la marca"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white mb-2"
                            >
                            <datalist id="marcas">
                                <option value="Toyota">
                                <option value="Honda">
                                <option value="Nissan">
                                <option value="Chevrolet">
                                <option value="Ford">
                                <option value="Hyundai">
                                <option value="Kia">
                                <option value="Mazda">
                                <option value="Volkswagen">
                                <option value="BMW">
                                <option value="Mercedes-Benz">
                                <option value="Audi">
                                <option value="Otra">
                            </datalist>
                        </div>
                        <div>
                            <input
                                type="number"
                                placeholder="Año del vehículo"
                                min="1900"
                                max="2024"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white"
                            >
                        </div>
                    </div>
                </div>

                <!-- Descripción -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Descripción del Producto
                    </label>
                    <textarea
                        rows="4"
                        required
                        class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                            dark:bg-gray-700 dark:text-white"
                    ></textarea>
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <a href="admin.html"
                class="px-6 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600
                    text-gray-700 dark:text-white rounded-md transition-colors duration-200">
                Cancelar
            </a>
            <button
                type="submit"
                class="px-6 py-2 bg-custom-blue hover:bg-custom-blue-light dark:bg-blue-600
                    dark:hover:bg-blue-700 text-white rounded-md transition-colors duration-200">
                Guardar Producto
            </button>
        </div>
    </form>
</div>
</main>

<script>
    // Función para previsualizar imágenes
    function previewImage(input, number) {
        const preview = document.getElementById(`preview${number}`);
        const placeholder = document.getElementById(`placeholder${number}`);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Script para el modo oscuro
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.classList.add('dark');
    }
</script>
</body>
</html>