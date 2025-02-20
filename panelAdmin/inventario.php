<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Autorepuestos Johbri</title>
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
            <div class="text-xl font-bold">Autorepuestos Johbri, C.A.</div>
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
        <!-- Encabezado y Botón Agregar -->
        <div class="max-w-7xl mx-auto mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Inventario</h1>
            <a href="agregarProducto.php"
                class="bg-custom-blue hover:bg-custom-blue-light text-white px-4 py-2 rounded-md
                    transition-colors duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Agregar Producto
            </a>
        </div>

        <!-- Filtros Avanzados -->
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Búsqueda por código único -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Código Único
                    </label>
                    <input type="text"
                        placeholder="Ej: REP-2024-001"
                        class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                            dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                </div>

                <!-- Búsqueda por nombre -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Nombre del producto
                    </label>
                    <input type="text"
                        placeholder="Buscar..."
                        class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                            dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                </div>

                <!-- Categoría -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Categoría
                    </label>
                    <select class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                            dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        <option value="">Todas las categorías</option>
                        <option>Frenos</option>
                        <option>Suspensión</option>
                        <option>Motor</option>
                        <option>Transmisión</option>
                        <option>Electricidad</option>
                    </select>
                </div>

                <!-- Marca -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Marca
                    </label>
                    <select class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                            dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        <option value="">Todas las marcas</option>
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
                        Stock
                    </label>
                    <select class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                            dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        <option value="">Todos</option>
                        <option value="low">Bajo stock</option>
                        <option value="out">Sin stock</option>
                    </select>
                </div>
            </div>

            <!-- Rango de precios -->
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Precio mínimo
                    </label>
                    <input type="number"
                        placeholder="0.00"
                        class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                            dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Precio máximo
                    </label>
                    <input type="number"
                        placeholder="999.99"
                        class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                            dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                </div>
                <div class="lg:col-span-2 flex items-end">
                    <button class="w-full md:w-auto px-6 py-2 bg-custom-blue hover:bg-custom-blue-light
                        text-white rounded-md transition-colors duration-200">
                        Aplicar Filtros
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabla de Inventario -->
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Código Único
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Producto
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Categoría
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Marca
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Stock
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Precio
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Producto 1 -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    REP-2024-001
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded-lg object-cover"
                                            src="../images/juego_pastillas_freno.jpg"
                                            alt="Pastillas de freno">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            Pastillas de Freno Delanteras
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            SKU: PRD-001
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">Frenos</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">Toyota</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    15 unidades
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">$45.00</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button class="text-custom-blue hover:text-custom-blue-light dark:text-blue-400 dark:hover:text-blue-300"
                                            title="Ver detalles">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    <button class="text-yellow-500 hover:text-yellow-600 dark:text-yellow-400 dark:hover:text-yellow-300"
                                            title="Editar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </button>
                                    <button class="text-red-500 hover:text-red-600 dark:text-red-400 dark:hover:text-red-300"
                                            title="Eliminar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
    </script>
</body>
</html>