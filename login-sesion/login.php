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
    <form action="../logica/loguear.php" class="space-y-6">
    <main class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl max-w-md w-full">
            <h2 class="text-2xl font-bold text-custom-blue dark:text-white text-center mb-6">
                Iniciar Sesión
            </h2>
            <form class="space-y-6" onsubmit="return validarLogin(event)">
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
    </form>

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

        /**
         * Valida el inicio de sesión.
         * @param {Event} event El evento de formulario que se está manejando.
         * @return {boolean} false para evitar que el formulario se envíe.
         */
        function validarLogin(event) {
            event.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Validación simple: si ambos campos son "admin", redirige al panel de administración
            if (username === 'admin' && password === 'admin') {
                window.location.href = 'admin.html';
            } else {
                window.location.href = 'sistema.html';
            }

            return false;
        }
    </script>
</body>
</html>


