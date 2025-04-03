<?php
session_start();

if(!ISSET($_SESSION['id'])){
    header('location:../login-sesion/login.php?error_message=Acceso denegado');

}

else{
   
    if((time() - $_SESSION['time']) > 600){
        session_unset();
        session_destroy();
        header('location:../login-sesion/login.php?error_message=Tiempo de sesión agotado');
    }
}

$_SESSION['time'] = time();

$success_message = isset($_GET['success_message']) ? $_GET['success_message'] : '';

?>
<!DOCTYPE html>
<html lang="es" class="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/ico" href="../assets/images/configuraciones.ico">
<title>Agregar Producto - Autorepuestos Johbri</title>
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
                <a href="../logica/cerrar-sesion.php" class="hover:underline">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="pt-24 px-6 pb-20">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Agregar Nuevo Producto</h1>
                <p class="text-gray-600 dark:text-gray-400">Complete todos los campos para registrar un nuevo producto</p>
            </div>

            <form action="../logica/agregar.php" method="POST" enctype = "multipart/form-data" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <!-- Información Básica -->
                <div class="space-y-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">
                        Información Básica
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Código Único del Repuestos *
                            </label>
                            <div class="relative">
                                <input type="text" required
                                    name = "num_parte"
                                    id = "num_parte"
                                    placeholder="Ingrese el codigo único"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                        dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                            </div>
                        </div>

                        <!-- Nombre del Producto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nombre del Producto *
                            </label>
                            <input type="text" required
                            id = "nombre_producto"
                            name = "nombre_producto"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- Categoría -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Categoría *
                            </label>
                            <select required
                                name = "categoria"
                                id = "categoria"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                                <option value="">Seleccione una categoría</option>
                                <option>Frenos</option>
                                <option>Inyección</option>
                                <option>Estoperas</option>
                                <option>Suspensión</option>
                                <option>Motor</option>
                                <option>Filtros</option>
                                <option>Carroceria</option>
                                <option>Accesorios</option>
                                <option>Transmisión</option>
                                <option>Electricidad</option>
                                <option>Otros</option>
                            </select>
                        </div>

                        <!-- Marca -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Marca *
                            </label>
                            <select required
                                name = "marca"
                                id = "marca"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                                <option value="">Seleccione una marca</option>
                                <option>Honda</option>
                                <option>Fiat</option>
                                <option>Renaul</option>
                                <option>Peugeot</option>
                                <option>Mercedes Benz</option>
                                <option>Chery</option>
                                <option>Hyundai</option>
                                <option>Kia</option>
                                <option>Toyota</option>
                                <option>Mitsubishi</option>
                                <option>Honda</option>
                                <option>Chevrolet</option>
                                <option>Ford</option>
                                <option>Nissan</option>
                            </select>
                        </div>

                        <!-- Precio -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Precio *
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 dark:text-gray-400">
                                    $
                                </span>
                                <input type="number" required
                                    name = "precio"
                                    id = "precio"
                                    step="0.01" min="0"
                                    placeholder="0.00"
                                    class="w-full pl-8 pr-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                        dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                            </div>
                        </div>

                        <!-- Stock -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Stock Inicial *
                            </label>
                            <input type="number" required
                                name = "stock"
                                id = "stock"
                                min="0"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Descripción
                        </label>
                        <textarea rows="4"
                            name = "descripcion"
                            id = "descripcion"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"></textarea>
                    </div>

<!-- Contenedor de imágenes -->
<div class="flex flex-wrap justify-center gap-4">
    <!-- Imagen 1 -->
    <div class="flex flex-col items-center px-4 pt-3 pb-3 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
        <div id="preview-1" class="hidden">
            <img class="mx-auto h-24 w-24 object-cover rounded-lg" src="" alt="Vista previa">
            <button type="button" onclick="removeImage(1)" class="mt-2 text-xs text-red-500 hover:text-red-700">
                Eliminar
            </button>
        </div>
        <div id="upload-1">
            <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="flex text-xs text-gray-600 dark:text-gray-400">
                <label for="file-upload-1" class="relative cursor-pointer rounded-md font-medium text-custom-blue hover:text-custom-blue-light">
                    <span>Imagen 1</span>
                    <input id="file-upload-1" name="file-upload-1" type="file" class="sr-only" accept="image/*" onchange="previewImage(this, 1)">
                </label>
            </div>
        </div>
        <div id="error-1" class="hidden">
            <p class="text-xs text-red-500"></p>
        </div>
    </div>

    <!-- Imagen 2 -->
    <div class="flex flex-col items-center px-4 pt-3 pb-3 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
        <div id="preview-2" class="hidden">
            <img class="mx-auto h-24 w-24 object-cover rounded-lg" src="" alt="Vista previa">
            <button type="button" onclick="removeImage(2)" class="mt-2 text-xs text-red-500 hover:text-red-700">
                Eliminar
            </button>
        </div>
        <div id="upload-2">
            <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="flex text-xs text-gray-600 dark:text-gray-400">
                <label for="file-upload-2" class="relative cursor-pointer rounded-md font-medium text-custom-blue hover:text-custom-blue-light">
                    <span>Imagen 2</span>
                    <input id="file-upload-2" name="file-upload-2" type="file" class="sr-only" accept="image/*" onchange="previewImage(this, 2)">
                </label>
            </div>
        </div>
        <div id="error-2" class="hidden">
            <p class="text-xs text-red-500"></p>
        </div>
    </div>

    <!-- Imagen 3 -->
    <div class="flex flex-col items-center px-4 pt-3 pb-3 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
        <div id="preview-3" class="hidden">
            <img class="mx-auto h-24 w-24 object-cover rounded-lg" src="" alt="Vista previa">
            <button type="button" onclick="removeImage(3)" class="mt-2 text-xs text-red-500 hover:text-red-700">
                Eliminar
            </button>
        </div>
        <div id="upload-3">
            <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="flex text-xs text-gray-600 dark:text-gray-400">
                <label for="file-upload-3" class="relative cursor-pointer rounded-md font-medium text-custom-blue hover:text-custom-blue-light">
                    <span>Imagen 3</span>
                    <input id="file-upload-3" name="file-upload-3" type="file" class="sr-only" accept="image/*" onchange="previewImage(this, 3)">
                </label>
            </div>
        </div>
        <div id="error-3" class="hidden">
            <p class="text-xs text-red-500"></p>
        </div>
    </div>

    <!-- Imagen 4 -->
    <div class="flex flex-col items-center px-4 pt-3 pb-3 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
        <div id="preview-4" class="hidden">
            <img class="mx-auto h-24 w-24 object-cover rounded-lg" src="" alt="Vista previa">
            <button type="button" onclick="removeImage(4)" class="mt-2 text-xs text-red-500 hover:text-red-700">
                Eliminar
            </button>
        </div>
        <div id="upload-4">
            <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="flex text-xs text-gray-600 dark:text-gray-400">
                <label for="file-upload-4" class="relative cursor-pointer rounded-md font-medium text-custom-blue hover:text-custom-blue-light">
                    <span>Imagen 4</span>
                    <input id="file-upload-4" name="file-upload-4" type="file" class="sr-only" accept="image/*" onchange="previewImage(this, 4)">
                </label>
            </div>
        </div>
        <div id="error-4" class="hidden">
            <p class="text-xs text-red-500"></p>
        </div>
    </div>
</div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            Formatos permitidos: PNG, JPG, GIF. Tamaño máximo: 10MB por imagen
                        </p>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="mt-8 flex justify-end space-x-4">
                    <div id="errores" class="text-red-500 text-sm mr-auto"></div>
                    <button type="submit"
                        onclick="return validarFormulario(event)"
                        class="px-4 py-2 bg-custom-blue hover:bg-custom-blue-light text-white rounded-md
                            transition-colors duration-200">
                        Guardar Producto
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

        function mostrarNombre() {
        const inputArchivo = document.getElementById('archivo');
        const archivo = inputArchivo.files[0]; // Obtiene el primer archivo seleccionado
        if (archivo) {
            console.log('Nombre del archivo:', archivo.name); // Muestra el nombre del archivo
        }
}

/**
 * Valida y muestra una previsualización de la imagen seleccionada
 *
 * Esta función realiza las siguientes tareas:
 * - Obtiene la imagen seleccionada del input file
 * - Valida que sea un archivo de tipo imagen
 * - Valida que el tamaño sea menor a 10MB
 * - Muestra mensajes de error si no cumple las validaciones
 * - Muestra una previsualización de la imagen si pasa las validaciones
 * - Oculta el área de carga y muestra la previsualización
 *
 * @param {HTMLInputElement} input - El elemento input de tipo file que contiene la imagen
 * @param {number} number - Número identificador del contenedor de previsualización
 * @returns {void}
 */


function previewImage(input, number) {
    const preview = document.getElementById(`preview-${number}`);
    const upload = document.getElementById(`upload-${number}`);
    const error = document.getElementById(`error-${number}`);
    const file = input.files[0];
    // Resetear mensajes de error
    error.classList.add('hidden');
    error.querySelector('p').textContent = '';
    if (file) {
        // Validar tipo de archivo
        if (!file.type.startsWith('image/')) {
            error.classList.remove('hidden');
            error.querySelector('p').textContent = 'Por favor, seleccione un archivo de imagen válido.';
            input.value = '';
            return;
        }
        // Validar tamaño (10MB = 10 * 1024 * 1024 bytes)
        if (file.size > 10 * 1024 * 1024) {
            error.classList.remove('hidden');
            error.querySelector('p').textContent = 'La imagen debe ser menor a 10MB.';
            input.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('hidden');
            upload.classList.add('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function removeImage(number) {
    const preview = document.getElementById(`preview-${number}`);
    const upload = document.getElementById(`upload-${number}`);
    const input = document.getElementById(`file-upload-${number}`);
    preview.classList.add('hidden');
    preview.querySelector('img').src = '';
    upload.classList.remove('hidden');
    input.value = '';
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

function validarFormulario(event) {
    event.preventDefault();
    let errores = [];

    // Validar código único
    const numParte = document.getElementById('num_parte').value.trim();
    if (!numParte) {
        errores.push("El código único del repuesto es obligatorio");
    }

    // Validar nombre del producto
    const nombreProducto = document.getElementById('nombre_producto').value.trim();
    if (!nombreProducto) {
        errores.push("El nombre del producto es obligatorio");
    }

    // Validar categoría
    const categoria = document.getElementById('categoria').value;
    if (!categoria) {
        errores.push("Debe seleccionar una categoría");
    }

    // Validar marca
    const marca = document.getElementById('marca').value;
    if (!marca) {
        errores.push("Debe seleccionar una marca");
    }

    // Validar precio
    const precio = document.getElementById('precio').value;
    if (!precio) {
        errores.push("El precio es obligatorio");
    } else if (precio <= 0) {
        errores.push("El precio debe ser mayor a 0");
    }

    // Validar stock
    const stock = document.getElementById('stock').value;
    if (!stock) {
        errores.push("El stock inicial es obligatorio");
    } else if (stock < 0) {
        errores.push("El stock no puede ser negativo");
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

// Mostrar alerta de éxito si existe
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