<?php
require '../logica/conexionbdd.php';
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

$error_message = isset($_GET['error_message']) ? $_GET['error_message'] : '';
$success_message = isset($_GET['success_message']) ? $_GET['success_message'] : '';

// Obtener el ID del cliente desde la URL
$cliente_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si el ID del cliente es válido
if ($cliente_id > 0) {
    // Preparar la consulta para obtener la información del cliente
    $query = $conn->prepare("SELECT * FROM clientes WHERE id = ?");
    $query->bind_param("i", $cliente_id);
    $query->execute();
    $result = $query->get_result();

    // Verificar si se encontró el cliente
    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
    } else {
        header('location:../login-sesion/login.php?error_message=Cliente no encontrado');
        exit();
    }
} else {
    header('location:../login-sesion/login.php?error_message=ID de cliente inválido');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="../assets/images/configuraciones.ico">
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

    <!-- Alerta de errores -->
    <div id="alertaError" class="fixed top-0 left-0 right-0 z-50 transform -translate-y-full transition-transform duration-300 ease-in-out">
        <div class="max-w-4xl mx-auto mt-20 p-4 rounded-md bg-red-50 dark:bg-red-900 border border-red-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <!-- Ícono de error -->
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3" id="mensajeError">
                    <!-- Los mensajes de error se insertarán aquí -->
                    <?php echo isset($error_message) ? htmlspecialchars($error_message) : ''; ?>
                    <p class="text-red-600 dark:text-red-200" id="errorMensaje"></p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button onclick="cerrarAlerta()" class="inline-flex rounded-md p-1.5 text-red-500 hover:bg-red-100 dark:hover:bg-red-800 transition-colors duration-200">
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
        </div>
    </div>


    <!-- Alerta de éxito -->
    <?php if ($success_message): ?>
        <div id="alertaExito" class="fixed top-0 left-0 right-0 z-50 transform -translate-y-full transition-transform duration-300 ease-in-out">
            <div class="max-w-4xl mx-auto mt-20 p-4 rounded-md bg-green-50 dark:bg-green-900 border border-green-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <!-- Ícono de éxito -->
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1.707-5.707a1 1 0 011.414 0L10 12.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700 dark:text-green-200"><?php echo htmlspecialchars($success_message); ?></p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button onclick="cerrarAlertaExito()" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 dark:hover:bg-green-800 transition-colors duration-200">
                                <span class="sr-only">Cerrar</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

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
                <a href="../logica/cerrar-sesion.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="pt-24 px-6 pb-20">
        <div class="max-w-4xl mx-auto">
            <!-- Encabezado -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Editar Cliente</h1>
                <p class="text-gray-600 dark:text-gray-400">Modifique los campos necesarios para actualizar la información del cliente empresarial</p>
            </div>

            <form action="../logica/actualizar-clientes.php" method="POST" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6" novalidate>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($cliente['id']); ?>">
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
                                value="<?php echo htmlspecialchars($cliente['nombre_empresa']); ?>"
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
                                value="<?php echo htmlspecialchars($cliente['rif']); ?>"
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
                                value="<?php echo htmlspecialchars($cliente['telefono_empresa']); ?>"
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
                                dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"><?php echo htmlspecialchars($cliente['direccion']); ?></textarea>
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
                                value="<?php echo htmlspecialchars($cliente['nombre_encargado']); ?>"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- Cédula del Contacto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Cédula *
                            </label>
                            <input type="text" required name="cedula_encargado" id="cedula_encargado"
                                value="<?php echo htmlspecialchars($cliente['cedula_encargado']); ?>"
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
                                value="<?php echo htmlspecialchars($cliente['telefono_encargado']); ?>"
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
                                value="<?php echo htmlspecialchars($cliente['correo']); ?>"
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
                                    value="<?php echo htmlspecialchars($cliente['contrasena']); ?>"
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

                        <?php if ($cliente['intentos'] == 3): ?>

                            <div class="flex items-center mb-4">
                                <input id="Usuario_bloqueado" type="checkbox" value="3" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                                <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Usuario bloqueado</label>
                            </div>

                        <?php endif; ?>

                        <?php if ($cliente['intentos'] < 3): ?>

                            <div class="flex items-center mb-4">
                                <input id="Usuario_bloqueado" type="checkbox" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Usuario Bloqueado</label>
                            </div>

                        <?php endif; ?>
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
                        Actualizar Cliente
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

    function mostrarAlerta(mensajes) {
        const alertaError = document.getElementById('alertaError');
        const mensajeError = document.getElementById('mensajeError');
        // Crear lista de errores con estilo mejorado
        const listaErrores = mensajes.map(error =>
            `<p class="text-sm text-red-700 dark:text-red-200">• ${error}</p>`
        ).join('');
        mensajeError.innerHTML = listaErrores;
        // Mostrar alerta con animación
        alertaError.classList.remove('-translate-y-full');
        // Desplazar la página hacia arriba
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function cerrarAlerta() {
        const alertaError = document.getElementById('alertaError');
        alertaError.classList.add('-translate-y-full');
    }

    function cerrarAlertaExito() {
        const alertaExito = document.getElementById('alertaExito');
        alertaExito.classList.add('-translate-y-full');
    }

    <?php if ($error_message): ?>
    document.addEventListener('DOMContentLoaded', function() {
        const alertaError = document.getElementById('alertaError');
        alertaError.classList.remove('-translate-y-full');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    <?php endif; ?>

    <?php if ($success_message): ?>
    document.addEventListener('DOMContentLoaded', function() {
        const alertaExito = document.getElementById('alertaExito');
        alertaExito.classList.remove('-translate-y-full');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    <?php endif; ?>
</script>

</body>
</html>