<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorepuestos Johbri, C.A.</title>
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
        .bg-pattern {
            background-image:
                linear-gradient(to bottom,
                    rgba(255, 255, 255, 0.85) 0%,
                    rgba(255, 255, 255, 0.85) 100%),
                url('../images/fondo_home.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .dark .bg-pattern {
            background-image:
                linear-gradient(to bottom,
                    rgba(17, 24, 39, 0.97) 0%,
                    rgba(17, 24, 39, 0.97) 100%),
                url('../images/fondo_home.jpeg');
        }
    </style>
</head>
<body class="bg-pattern transition-colors duration-200">
    <nav class="bg-custom-blue/95 backdrop-blur-sm dark:bg-gray-800/95 text-white px-6 py-4 flex justify-between items-center fixed w-full top-0 z-50 shadow-lg">
        <a href="index.html" class="text-xl sm:text-2xl font-bold hover:opacity-90 transition-opacity">
            Autorepuestos Johbri, C.A.
        </a>
        <button
            onclick="document.documentElement.classList.toggle('dark')"
            class="p-2 rounded-full bg-gray-700 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-700 transition-colors duration-200"
        >
            <span class="dark:hidden">🌙</span>
            <span class="hidden dark:inline">☀️</span>
        </button>
    </nav>
    <main class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl max-w-md w-full">
            <!-- Alerta de Error -->
            <div id="errorAlert" class="mb-6 p-4 rounded-md bg-red-50 dark:bg-red-900/50 border border-red-500 hidden">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <!-- Ícono de error -->
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-500 dark:text-red-400">
                        <?php
                            if (isset($_GET['error_message'])) {
                                echo urldecode($_GET['error_message']); 
                            }
                            ?>
                        </p>
                    </div>
                    <!-- Botón cerrar -->
                    <div class="ml-auto pl-3">
                        <button type="button"
                            onclick="document.getElementById('errorAlert').classList.add('hidden')"
                            class="text-red-400 hover:text-red-500 focus:outline-none">
                            <span class="sr-only">Cerrar</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-custom-blue dark:text-white text-center mb-6">
                Iniciar Sesión
            </h2>
            <form class="space-y-6" action="../logica/loguear.php" method="POST"">
                <div class="space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Correo Electronico
                        </label>
                        <input
                            type="username"
                            id="username"
                            name="username"
                            required
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                focus:ring-2 focus:ring-custom-blue dark:focus:ring-blue-500
                                focus:border-transparent dark:bg-gray-700 dark:text-white"
                        >
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Contraseña
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                focus:ring-2 focus:ring-custom-blue dark:focus:ring-blue-500
                                focus:border-transparent dark:bg-gray-700 dark:text-white"
                        >
                    </div>
                    <!-- Agregar enlace de olvidaste contraseña -->
                    <div class="flex items-center justify-end">
                        <a href="#"
                        onclick="mostrarRecuperacion(event)"
                        class="text-sm text-custom-blue dark:text-blue-400 hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>
                <button
                    type="submit"
                    class="w-full bg-custom-blue hover:bg-custom-blue-light dark:bg-blue-600
                        dark:hover:bg-blue-700 text-white py-2 px-4 rounded-md
                        transition-colors duration-200 font-semibold mt-6"
                >
                    Ingresar al Sistema
                </button>
            </form>
            <div class="mt-4 text-center">
                <a href="index.html" class="text-custom-blue dark:text-blue-400 hover:underline text-sm">
                    Volver al inicio
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-custom-blue/95 dark:bg-gray-800/95 backdrop-blur-sm text-white text-center py-4 fixed bottom-0 w-full text-sm sm:text-base shadow-lg">
        <p>&copy; 2025 Autorepuestos Johbri, C.A. - Todos los derechos reservados</p>
    </footer>

    <!-- Este script detecta si el sistema operativo del usuario está configurado en modo oscuro
        y aplica automáticamente el tema oscuro a la página web al cargarla por primera vez.
    -->
    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>


