
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
        <div class="text-xl sm:text-2xl font-bold">
            <a href="../index.php">
                Autorepuestos Johbri, C.A.
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
        </div>
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
                    <div class="ml-3 flex justify-center items-center">
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
            <form class="space-y-6" action="../logica/loguear-cliente.php" method="POST"">
                <div class="space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Correo Electronico
                        </label>
                        <input
                            type="email"
                            id="username"
                            name="username"
                            required
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:border-custom-blue dark:focus:border-blue-500 dark:bg-gray-700 dark:text-white"
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
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:border-custom-blue dark:focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        >
                    </div>
                    <!-- Enlaces de navegación -->
                    <div class="flex items-center justify-between">
                        <a href="./login.php"
                        class="text-sm text-custom-blue dark:text-blue-400 hover:underline">
                            ¿Eres Admin?
                        </a>
                        <a href="./olvidarContraseña.php"
                        class="text-sm text-custom-blue dark:text-blue-400 hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                    <div class="flex items-center justify-end">

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
            <div class="mt-4    text-center">
                <a href="../index.php" class="text-custom-blue dark:text-blue-400 hover:underline text-sm">
                    Volver al inicio
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-custom-blue/95 dark:bg-gray-800/95 backdrop-blur-sm text-white text-center py-4 fixed bottom-0 w-full text-sm sm:text-base shadow-lg">
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


