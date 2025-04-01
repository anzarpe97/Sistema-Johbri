<?php
session_start();
if(!ISSET($_SESSION['id'])){
  header('location:../login-sesion/login.php');
}
else{
  if((time() - $_SESSION['time']) > 600){
    session_unset();
    session_destroy();
    header('location:../login-sesion/login.php');
  }
}
$_SESSION['time'] = time();
?>
<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/ico" href="../assets/images/configuraciones.ico">
  <title>Reportes - Autorepuestos Johbri</title>
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
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Reportes</h1>
        <p class="text-gray-600 dark:text-gray-400">Seleccione el tipo de reporte y utilice los filtros para generar reportes específicos</p>
      </div>
      <form class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Tipo de Reporte
          </label>
          <select name="tipo_reporte" id="tipo_reporte" class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue" onchange="toggleFilters()">
            <option value="">Seleccione un tipo de reporte</option>
            <option value="clientes">Clientes</option>
            <option value="repuestos">Repuestos</option>
          </select>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Filtro Clientes Activos/Inactivos -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Estado de Clientes
            </label>
            <select name="estado_clientes" id="estado_clientes" class="cliente-filter w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue" disabled>
              <option value="">Seleccione un estado</option>
              <option value="activos">Activos</option>
              <option value="inactivos">Inactivos</option>
            </select>
          </div>
          <!-- Filtro Repuestos con Stock/Sin Stock -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Estado de Stock
            </label>
            <select name="estado_stock" id="estado_stock" class="repuesto-filter w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue" disabled>
              <option value="">Seleccione un estado</option>
              <option value="con_stock">Con Stock</option>
              <option value="sin_stock">Sin Stock</option>
            </select>
          </div>
          <!-- Filtro Categoría de Repuestos -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Categoría de Repuestos
            </label>
            <select name="categoria_repuestos" id="categoria_repuestos" class="repuesto-filter w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue" disabled>
              <option value="">Seleccione una categoría</option>
              <option>Frenos</option>
              <option>Inyección</option>
              <option>Estoperas</option>
              <option>Suspensión</option>
              <option>Motor</option>
              <option>Filtros</option>
              <option>Carrocería</option>
              <option>Accesorios</option>
              <option>Transmisión</option>
              <option>Electricidad</option>
              <option>Otros</option>
            </select>
          </div>
          <!-- Filtro Marca de Repuestos -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Marca de Repuestos
            </label>
            <select name="marca_repuestos" id="marca_repuestos" class="repuesto-filter w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue" disabled>
              <option value="">Seleccione una marca</option>
              <option>Marca A</option>
              <option>Marca B</option>
              <option>Marca C</option>
            </select>
          </div>
        </div>
        <div class="mt-6">
          <button type="submit" class="w-full px-4 py-2 bg-custom-blue text-white rounded-md hover:bg-custom-blue-light transition-colors duration-200">Generar Reporte</button>
        </div>
      </form>
      <!-- Tabla de Resultados -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Resultados del Reporte</h2>
        <table class="w-full table-auto">
          <thead>
            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
              <th class="px-4 py-2">Código</th>
              <th class="px-4 py-2">Nombre</th>
              <th class="px-4 py-2">Categoría</th>
              <th class="px-4 py-2">Marca</th>
              <th class="px-4 py-2">Stock</th>
              <th class="px-4 py-2">Estado Cliente</th>
            </tr>
          </thead>
          <tbody id="tablaResultados">
            <!--
          generar filas de tabla resultado con php y colocar resultados de filtros
            -->
          </tbody>
        </table>
      </div>
    </div>
    </main>
    <script>
    function toggleFilters() {
    const reportType = document.getElementById('tipo_reporte').value;
    const clienteFilters = document.querySelectorAll('.cliente-filter');
    const repuestoFilters = document.querySelectorAll('.repuesto-filter');

    if (reportType === 'clientes') {
        clienteFilters.forEach(filter => filter.disabled = false);
        repuestoFilters.forEach(filter => filter.disabled = true);
    } else if (reportType === 'repuestos') {
        clienteFilters.forEach(filter => filter.disabled = true);
        repuestoFilters.forEach(filter => filter.disabled = false);
    } else {
        clienteFilters.forEach(filter => filter.disabled = true);
        repuestoFilters.forEach(filter => filter.disabled = true);
    }

    updateTableHeaders(reportType);
}

    function updateTableHeaders(reportType) {
        const tableHead = document.querySelector('thead');
        tableHead.innerHTML = '';

        if (reportType === 'clientes') {
            tableHead.innerHTML = `
                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                    <th class="px-4 py-2">ID Cliente</th>
                    <th class="px-4 py-2">Empresa</th>
                    <th class="px-4 py-2">Correo</th>
                    <th class="px-4 py-2">Teléfono</th>
                    <th class="px-4 py-2">Estado</th>
                </tr>
            `;
        } else if (reportType === 'repuestos') {
            tableHead.innerHTML = `
                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                    <th class="px-4 py-2">Código</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Categoría</th>
                    <th class="px-4 py-2">Marca</th>
                    <th class="px-4 py-2">Stock</th>
                </tr>
            `;
        }
    }
  </script>
  </body>
</html>
