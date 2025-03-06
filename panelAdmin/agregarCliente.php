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

$_SESSION['ultimo_acceso'] = time();
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

            <form action="../logica/registrar-clientes.php" method="POST" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6" novalidate>
                <div class="space-y-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">
                        Información de la Empresa
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nombre de la Empresa *
                            </label>
                            <input type="text" required
                                   id="nombre_empresa"
                                   name="nombre_empresa"
                                   class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- RIF -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                RIF *
                            </label>
                            <input type="text" required
                                   id="rif"
                                   name="rif"
                                   placeholder="J-12345678-9"
                                   class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Teléfono de la Empresa *
                            </label>
                            <input type="tel" required
                                   id="telefono_empresa"
                                   name="telefono_empresa"
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
                        <textarea required name="direccion" id="direccion"
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
                            <input type="text" required name="nombre_contacto" id="nombre_contacto"
                                   class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- Cédula del Contacto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Cédula *
                            </label>
                            <input type="text" required name="cedula_encargado" id="cedula_encargado"
                                   placeholder="V-12345678"
                                   class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- Teléfono del Contacto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Teléfono Encargado *
                            </label>
                            <input type="tel" required name="telefono_encargado" id="telefono_encargado"
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
                            <input type="email" required name="correo_empresa" id="correo_empresa"
                                   class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Contraseña *
                            </label>
                            <div class="relative">
                                <input type="password" required
                                       id="password"
                                       name="password"
                                       class="w-full px-4 py-2 pr-10 rounded-md border border-gray-300 dark:border-gray-600
                                       dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                                <button type="button"
                                        onclick="togglePassword()"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg id="showPassword" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="hidePassword" class="h-5 w-5 text-gray-500 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
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
        <p>&copy; 2025 Autorepuestos Johbri, C.A. - Todos los derechos reservados</p>
    </footer>

    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const showIcon = document.getElementById('showPassword');
            const hideIcon = document.getElementById('hidePassword');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showIcon.classList.add('hidden');
                hideIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                showIcon.classList.remove('hidden');
                hideIcon.classList.add('hidden');
            }
        }
    </script>
</body>
</html>