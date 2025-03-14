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
                url('../assets/images/fondo_home.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .dark .bg-pattern {
            background-image:
                linear-gradient(to bottom,
                    rgba(17, 24, 39, 0.97) 0%,
                    rgba(17, 24, 39, 0.97) 100%),
                url('../assets/images/fondo_home.jpeg');
        }
    </style>
</head>
<body class="bg-pattern transition-colors duration-200">
    <nav class="bg-custom-blue/95 backdrop-blur-sm dark:bg-gray-800/95 text-white px-6 py-4 flex justify-between items-center fixed w-full top-0 z-50 shadow-lg">
        <div class="text-xl sm:text-2xl font-bold">Autorepuestos Johbri, C.A.</div>
        <div class="flex items-center gap-4">
            <button
                onclick="document.documentElement.classList.toggle('dark')"
                class="p-2 rounded-full bg-gray-700 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-700 transition-colors duration-200"
            >
                <span class="dark:hidden">🌙</span>
                <span class="hidden dark:inline">☀️</span>
            </button>
        </div>
    </nav>

    <main class="min-h-screen flex flex-col items-center justify-center px-4 text-center relative">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-custom-blue dark:text-white mb-6 drop-shadow-lg">
                Bienvenidos a Autorepuestos Johbri
            </h1>
            <p class="text-xl sm:text-2xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed mb-12">
                Tu solución integral en repuestos automotrices. Ofrecemos una amplia gama de productos de alta calidad para mantener tu vehículo en óptimas condiciones.
            </p>
        </div>
        <a
                href="login-sesion/loginCliente.php"
                class="px-8 py-3 text-lg bg-custom-blue-light text-white dark:bg-custom-blue dark:text-white rounded-full hover:bg-custom-blue dark:hover:bg-gray-600 transition-colors duration-200 font-semibold shadow-md"
            >
                Iniciar Sesión
            </a>
    </main>

    <footer class="bg-custom-blue/95 dark:bg-gray-800/95 backdrop-blur-sm text-white text-center py-4 fixed bottom-0 w-full text-sm sm:text-base shadow-lg">
        <p>&copy; 2024 Autorepuestos Johbri, C.A. - Todos los derechos reservados</p>
    </footer>

    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>
