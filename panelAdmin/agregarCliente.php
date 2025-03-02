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
            <a href="../index.php">Cerrar Sesión</a>
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

            <!-- Formulario -->
            <form class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6" novalidate>
                <!-- Información de la Empresa -->
                <div class="space-y-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">
                        Información de la Empresa
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre de la Empresa -->
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

    <!--OTROS CAMPOS BDD-->
                        <!-- Teléfono Empresa -->
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
                        <textarea required
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
                            <input type="text" required
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- Cédula del Contacto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Cédula *
                            </label>
                            <input type="text" required
                                placeholder="V-12345678"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- Teléfono del Contacto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Teléfono Móvil *
                            </label>
                            <input type="tel" required
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
                                Correo Electrónico *
                            </label>
                            <input type="email" required
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
                        onclick="return validarFormulario(event)"
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

        /**
         * Función que alterna la visibilidad de la contraseña
         *
         * Esta función cambia el tipo de input entre 'password' y 'text' para mostrar u ocultar
         * la contraseña. También alterna la visibilidad de los íconos de mostrar/ocultar.
         *
         * @returns {void}
         */
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

        /**
         * Valida el formulario de registro de cliente
         *
         * Esta función realiza validaciones en todos los campos del formulario de registro
         * de clientes empresariales. Verifica que los campos obligatorios estén completos
         * y que cumplan con los formatos requeridos.
         *
         * Validaciones realizadas:
         * - Nombre de empresa: Campo obligatorio
         * - RIF: Campo obligatorio, formato J-12345678-9
         * - Teléfono empresa: Campo obligatorio, formato 0212-1234567
         * - Dirección: Campo obligatorio
         * - Nombre contacto: Campo obligatorio
         * - Cédula: Campo obligatorio, formato V-1234567
         * - Teléfono móvil: Campo obligatorio
         *
         * @param {Event} event - El evento submit del formulario
         * @returns {boolean} false si hay errores de validación
         */
        function validarFormulario(event) {
            event.preventDefault();
            let errores = [];

            // Validar nombre de la empresa
            const nombreEmpresa = document.getElementById('nombre_empresa').value.trim();
            if (!nombreEmpresa) {
                errores.push("El nombre de la empresa es obligatorio");
            }

            // Validar RIF
            const rif = document.getElementById('rif').value.trim();
            if (!rif) {
                errores.push("El RIF es obligatorio");
            } else if (!/^[JVGE]-\d{8}-\d$/.test(rif)) {
                errores.push("El formato del RIF debe ser J-12345678-9");
            }

            // Validar teléfono empresa
            const telefonoEmpresa = document.getElementById('telefono_empresa').value.trim();
            if (!telefonoEmpresa) {
                errores.push("El teléfono de la empresa es obligatorio");
            } else if (!/^\d{4}-\d{7}$/.test(telefonoEmpresa)) {
                errores.push("El formato del teléfono debe ser 0212-1234567");
            }

            // Validar dirección
            const direccion = document.getElementById('direccion').value.trim();
            if (!direccion) {
                errores.push("La dirección es obligatoria");
            }

            // Validar nombre del contacto
            const nombreContacto = document.getElementById('nombre_contacto').value.trim();
            if (!nombreContacto) {
                errores.push("El nombre del contacto es obligatorio");
            }

            // Validar cédula
            const cedula = document.getElementById('cedula').value.trim();
            if (!cedula) {
                errores.push("La cédula es obligatoria");
            } else if (!/^[VE]-\d{7,8}$/.test(cedula)) {
                errores.push("El formato de la cédula debe ser V-1234567");
            }

            // Validar teléfono móvil
            const telefonoMovil = document.getElementById('telefono_movil').value.trim();
            if (!telefonoMovil) {
                errores.push("El teléfono móvil es obligatorio");
            } else if (!/^\d{4}-\d{7}$/.test(telefonoMovil)) {
                errores.push("El formato del teléfono debe ser 0414-1234567");
            }

            // Validar correo
            const correo = document.getElementById('correo').value.trim();
            if (!correo) {
                errores.push("El correo electrónico es obligatorio");
            } else if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(correo)) {
                errores.push("El formato del correo electrónico no es válido");
            }

            // Validar contraseña
            const password = document.getElementById('password').value;
            if (!password) {
                errores.push("La contraseña es obligatoria");
            } else if (password.length < 6) {
                errores.push("La contraseña debe tener al menos 6 caracteres");
            }

            // Verificar si el correo ya existe
            if (correo && !errores.some(error => error.includes("correo"))) {
                fetch('../logica/verificar_correo.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `correo=${encodeURIComponent(correo)}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.existe) {
                        mostrarAlerta(["Este correo electrónico ya está registrado"]);
                    } else if (errores.length > 0) {
                        mostrarAlerta(errores);
                    } else {
                        document.querySelector('form').submit();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    mostrarAlerta(["Error al verificar el correo electrónico"]);
                });
                return false;
            }

            // Si hay errores, mostrarlos y detener el envío
            if (errores.length > 0) {
                mostrarAlerta(errores);
                return false;
            }

            // Si no hay errores, enviar el formulario
            document.querySelector('form').submit();
            return true;
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
    </script>
</body>
</html>