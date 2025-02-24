<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pastillas de Freno Delanteras - Autorepuestos Johbri, C.A.</title>
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
  <main class="pt-24 px-6 pb-20 max-w-7xl mx-auto">
      <!-- Breadcrumb -->
      <div class="flex items-center space-x-2 text-sm mb-6">
          <a href="sistema.html" class="text-custom-blue dark:text-blue-400 hover:underline">Productos</a>
          <span class="text-gray-500 dark:text-gray-400">/</span>
          <span class="text-gray-600 dark:text-gray-300">Pastillas de Freno Delanteras</span>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <!-- Imagen y Galería -->
          <div class="space-y-4">
              <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                  <img src="./images/juego_pastillas_freno.jpg" alt="Pastillas de Freno" class="w-full h-96 object-cover">
              </div>
              <div class="grid grid-cols-4 gap-2">
                  <img src="./images/juego_pastillas_freno.jpg" alt="Vista 1" class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity">
                  <img src="./images/pastillas_detalle1.jpg" alt="Vista 2" class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity">
                  <img src="./images/pastillas_detalle2.jpg" alt="Vista 3" class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity">
                  <img src="./images/pastillas_detalle3.jpg" alt="Vista 4" class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity">
              </div>
          </div>

          <!-- Información del Producto -->
          <div class="space-y-6">
              <div>
                  <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                      Pastillas de Freno Delanteras
                  </h1>
                  <p class="text-sm text-gray-500 dark:text-gray-400">Código: PF-2024-001</p>
              </div>

              <div class="flex items-center space-x-4">
                  <span class="text-4xl font-bold text-custom-blue dark:text-blue-400">$45.00</span>
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                      En Stock (15 unidades)
                  </span>
              </div>

              <div class="prose dark:prose-invert max-w-none">
                  <h2 class="text-xl font-semibold mb-2 text-custom-blue dark:text-blue-400">Descripción</h2>
                  <p class="text-gray-600 dark:text-gray-300">
                      Juego de pastillas de freno de alta calidad, fabricadas con materiales de primera calidad para garantizar un frenado seguro y eficiente. Diseñadas para proporcionar un rendimiento óptimo y una larga vida útil.
                  </p>
              </div>

              <div>
                  <h2 class="text-xl font-semibold mb-3 text-custom-blue dark:text-blue-400">Características</h2>
                  <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                      <li class="flex items-center">
                          <span class="mr-2">✓</span>
                          Material de fricción de alta calidad
                      </li>
                      <li class="flex items-center">
                          <span class="mr-2">✓</span>
                          Bajo nivel de ruido
                      </li>
                      <li class="flex items-center">
                          <span class="mr-2">✓</span>
                          Excelente resistencia al desgaste
                      </li>
                      <li class="flex items-center">
                          <span class="mr-2">✓</span>
                          Incluye accesorios de instalación
                      </li>
                  </ul>
              </div>

              <div>
                  <h2 class="text-xl font-semibold mb-3 text-custom-blue dark:text-blue-400">Vehículos Compatibles</h2>
                  <div class="grid grid-cols-2 gap-4 text-sm">
                      <div class="space-y-2">
                          <p class="font-medium text-gray-700 dark:text-gray-200">Toyota</p>
                          <ul class="text-gray-600 dark:text-gray-400 space-y-1">
                              <li>• Corolla (2018-2024)</li>
                              <li>• Camry (2019-2024)</li>
                              <li>• RAV4 (2019-2024)</li>
                          </ul>
                      </div>
                      <div class="space-y-2">
                      <p class="font-medium text-gray-700 dark:text-gray-200">Honda</p>
                      <ul class="text-gray-600 dark:text-gray-400 space-y-1">
                          <li>• Civic (2017-2024)</li>
                          <li>• Accord (2018-2024)</li>
                          <li>• CR-V (2017-2024)</li>
                      </ul>
                      </div>
                  </div>
              </div>

              <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                  <a href="sistema.html"
                  class="inline-block bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-white px-6 py-2 rounded-md transition-colors duration-200 mr-4">
                      Volver
                  </a>
                  <button class="inline-block bg-custom-blue hover:bg-custom-blue-light dark:bg-blue-600 dark:hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-colors duration-200">
                      Agregar al Carrito
                  </button>
              </div>
          </div>
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