<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes - Autorepuestos Johbri</title>
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
        <!-- Encabezado y Botón Agregar -->
        <div class="max-w-7xl mx-auto mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gestión de Clientes</h1>
            <a href="agregarCliente.php"
                class="bg-custom-blue hover:bg-custom-blue-light text-white px-4 py-2 rounded-md
                    transition-colors duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Agregar Cliente
            </a>
        </div>

        <!-- Filtros -->
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row gap-4 items-end">
                <div class="w-full md:w-1/3">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Buscar cliente
                    </label>
                    <input
                        type="text"
                        placeholder="Nombre de la empresa"
                        class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                            dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                </div>
                <button class="w-full md:w-auto px-4 py-2 bg-custom-blue hover:bg-custom-blue-light text-white
                        rounded-md transition-colors duration-200">
                    Buscar
                </button>
            </div>
        </div>

        <!-- Lista de Clientes Desplegable -->
        <div class="max-w-7xl mx-auto">
            <!-- Cliente 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-4">
                <button onclick="toggleCliente('cliente1')"
                        class="w-full px-6 py-4 flex justify-between items-center text-left text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <span class="text-lg font-semibold">Taller Mecánico El Experto</span>
                        <span class="ml-3 px-2 py-1 text-sm bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full">
                            Activo
                        </span>
                    </div>
                    <svg id="arrow-cliente1" class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="info-cliente1" class="hidden p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Información de la Empresa -->
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">RIF</p>
                            <p class="text-lg text-gray-900 dark:text-white">J-12345678-9</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Teléfono Empresa</p>
                            <p class="text-lg text-gray-900 dark:text-white">0212-1234567</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Dirección de la Sede</p>
                            <p class="text-lg text-gray-900 dark:text-white">Av lalala calle tal zona tuki</p>
                        </div>

                        <!-- Información del Contacto Principal -->
                        <div class="md:col-span-2 mt-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">
                                Información del Contacto Principal
                            </h3>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Nombre Completo</p>
                            <p class="text-lg text-gray-900 dark:text-white">Juan Pérez</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Cédula</p>
                            <p class="text-lg text-gray-900 dark:text-white">V-12345678</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Teléfono Móvil</p>
                            <p class="text-lg text-gray-900 dark:text-white">0414-1234567</p>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex items-end justify-end md:col-span-2">
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
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agregar más clientes aquí con el mismo formato -->
        </div>
    </main>

    <footer class="bg-custom-blue dark:bg-gray-800 text-white text-center py-4 fixed bottom-0 w-full text-sm">
        <p>&copy; 2025 Autorepuestos Johbri, C.A. - Todos los derechos reservados</p>
    </footer>

    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }

        function toggleCliente(clienteId) {
            const info = document.getElementById('info-' + clienteId);
            const arrow = document.getElementById('arrow-' + clienteId);
            if (info.classList.contains('hidden')) {
                info.classList.remove('hidden');
                arrow.classList.add('rotate-180');
            } else {
                info.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            }
        }
    </script>
</body>
</html>