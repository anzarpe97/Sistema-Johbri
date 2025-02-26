<?php
        session_start();
        
        if (!isset($_SESSION['id'])) {
            header('Location: ../login-sesion/login.php');
            exit();
        }
?>


<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar cliente - Autorepuestos Johbri</title>
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
            <a href="../logica/cerrar-sesion.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="pt-24 px-6 pb-20">
        <div class="max-w-4xl mx-auto">
            <!-- Encabezado -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Registrar Nuevo Cliente</h1>
                <p class="text-gray-600 dark:text-gray-400">Complete todos los campos para registrar un nuevo cliente empresarial</p>
            </div>


            <form action="../logica/registrar-clientes.php" method="POST" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">

                <div class="space-y-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">
                        Información de la Empresa
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nombre de la Empresa *
                            </label>
                            <input type="text" required name = "nombre_empresa" id = "nombre_empresa" class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- RIF -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                RIF *
                            </label>
                            <input type="text" required name = "rif" id = "rif"
                                placeholder="J-12345678-9"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Teléfono de la Empresa *
                            </label>
                            <input type="tel" required name = "telefono_empresa" id = "telefono_empresa"
                                placeholder="0212-1234567"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>
                    </div>

                    <!-- Dirección -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Dirección de la Sede *
                        </label>
                        <textarea required name = "direccion" id = "direccion"
                            rows="2"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"></textarea>
                    </div>

                    <!-- Información del Contacto -->
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2 mt-8">
                        Información del Contacto Principal
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre del Contacto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nombre Completo *
                            </label>
                            <input type="text" required name = "nombre_contacto" id = "nombre_contacto"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- Cédula del Contacto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Cédula *
                            </label>
                            <input type="text" required name = "cedula_encargado" id = "cedula_encargado"
                                placeholder="V-12345678"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- Teléfono del Contacto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Teléfono Encargado *
                            </label>
                            <input type="tel" required name = "telefono_encargado" id = "telefono_encargado"
                                placeholder="0414-1234567"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>
                    </div>

                    <!-- Información de Acceso -->
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2 mt-8">
                        Información de Acceso al Sistema
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Correo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Correo Electrónico Empresa*
                            </label>
                            <input type="email" required name = "correo_empresa" id = "correo_empresa"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Contraseña *
                            </label>
                            <input type="password" required name = "contrasena" id = "contrasena"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="mt-8 flex justify-end space-x-4">
                    <button type="button"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 dark:text-gray-300
                            hover:bg-gray-50 dark:hover:bg-gray-700">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-custom-blue hover:bg-custom-blue-light text-white rounded-md
                            transition-colors duration-200">
                        Registrar Cliente
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