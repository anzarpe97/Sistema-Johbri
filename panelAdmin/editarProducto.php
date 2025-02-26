<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Autorepuestos Johbri</title>
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
                <a href="admin.php"
                class="text-xl hover:text-gray-200 transition-colors duration-200 flex items-center gap-2 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="text-sm">Volver</span>
                </a>
            </div>
            <div class="flex items-center gap-4">
                <button
                    onclick="document.documentElement.classList.toggle('dark')"
                    class="p-2 rounded-full bg-gray-700 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-700 transition-colors duration-200"
                >
                    <span class="dark:hidden">🌙</span>
                    <span class="hidden dark:inline">☀️</span>
                </button>
                <a href="login.html" class="hover:underline">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="pt-24 px-6 pb-20">
        <div class="max-w-4xl mx-auto">
            <!-- Encabezado -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Editar Producto</h1>
                <p class="text-gray-600 dark:text-gray-400">Modifica los detalles del producto según sea necesario</p>
            </div>

            <!-- Formulario -->
            <form class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <!-- Información básica -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre del producto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nombre del producto
                            </label>
                            <input type="text" 
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"
                                value="Pastillas de Freno Delanteras">
                        </div>

                        <!-- Precio -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Precio ($)
                            </label>
                            <input type="number" 
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"
                                value="45.00" step="0.01">
                        </div>

                        <!-- Categoría -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Categoría
                            </label>
                            <select class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                                <option>Frenos</option>
                                <option>Suspensión</option>
                                <option>Motor</option>
                                <option>Transmisión</option>
                                <option>Electricidad</option>
                                <option>Carrocería</option>
                            </select>
                        </div>

                        <!-- Marca -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Marca
                            </label>
                            <select class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                                <option>Toyota</option>
                                <option>Honda</option>
                                <option>Chevrolet</option>
                                <option>Ford</option>
                                <option>Nissan</option>
                            </select>
                        </div>

                        <!-- Stock -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Stock disponible
                            </label>
                            <input type="number" 
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"
                                value="15">
                        </div>

                        <!-- Estado -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Estado
                            </label>
                            <select class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                                <option>Activo</option>
                                <option>Suspendido</option>
                            </select>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Descripción del producto
                        </label>
                        <textarea 
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"
                            rows="4"
                        >Juego de pastillas de freno delanteras de alta calidad, diseñadas para un rendimiento óptimo y durabilidad excepcional.</textarea>
                    </div>

                    <!-- Imágenes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Imágenes del producto
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Imagen actual -->
                            <div class="relative">
                                <img src="./images/juego_pastillas_freno.jpg" alt="Imagen actual" 
                                    class="w-full h-32 object-cover rounded-lg">
                                <button type="button" 
                                    class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full hover:bg-red-600">
                                    ✕
                                </button>
                            </div>
                            
                            <!-- Subir nueva imagen -->
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4
                                    flex items-center justify-center cursor-pointer hover:border-custom-blue">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" 
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Añadir imagen</p>
                                </div>
                                <input type="file" class="hidden" accept="image/*">
                            </div>
                        </div>
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
            </form>
        </div>
    </main>

    <footer class="bg-custom-blue dark:bg-gray-800 text-white text-center py-4 fixed bottom-0 w-full text-sm">
        <p>&copy; 2024 Autorepuestos Johbri, C.A. - Todos los derechos reservados</p>
    </footer>

    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>
