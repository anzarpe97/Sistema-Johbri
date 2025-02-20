<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorepuestos Johbri</title>
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
            <div class="text-xl font-bold">Autorepuestos Johbri, C.A.</div>
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
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Agregar Nuevo Producto</h1>
                <p class="text-gray-600 dark:text-gray-400">Complete todos los campos para registrar un nuevo producto</p>
            </div>

            <form class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <!-- Información Básica -->
                <div class="space-y-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">
                        Información Básica
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Código Único -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Código Único del Repuesto *
                            </label>
                            <div class="relative">
                                <input type="text" required
                                    placeholder="REP-2024-001"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                        dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 block">
                                    Formato: REP-YYYY-XXX
                                </span>
                            </div>
                        </div>

                        <!-- Nombre del Producto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nombre del Producto *
                            </label>
                            <input type="text" required
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                        </div>

                        <!-- Categoría -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Categoría *
                            </label>
                            <select required
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                                <option value="">Seleccione una categoría</option>
                                <option>Frenos</option>
                                <option>Suspensión</option>
                                <option>Motor</option>
                                <option>Transmisión</option>
                                <option>Electricidad</option>
                            </select>
                        </div>

                        <!-- Marca -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Marca *
                            </label>
                            <select required
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                    dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
                                <option value="">Seleccione una marca</option>
                                <option>Toyota</option>
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
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue"></textarea>
                    </div>

                    <!-- Imágenes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Imágenes del Producto
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-custom-blue hover:text-custom-blue-light">
                                        <span>Subir archivos</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only" multiple>
                                    </label>
                                    <p class="pl-1">o arrastrar y soltar</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    PNG, JPG, GIF hasta 10MB
                                </p>
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
    </script>
</body>
</html>