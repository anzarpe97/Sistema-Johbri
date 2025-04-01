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

// Consulta para obtener los clientes
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$sql = "SELECT * FROM clientes";
if ($search) {
    $sql .= " WHERE nombre_empresa LIKE '%$search%'";
}
$result = $conn->query($sql);

$clientes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/ico" href="../assets/images/configuraciones.ico">
  <title>Gestión de Clientes - Autorepuestos Johbri</title>
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
      <!-- Encabezado y Botón Agregar -->
      <div class="max-w-7xl mx-auto mb-6 flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gestión de Clientes</h1>
          <a href="agregarCliente.php"
              class="bg-custom-blue hover:bg-custom-blue-light text-white px-4 py-2 rounded-md
                  transition-colors duration-200 flex items-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
              Agregar Cliente
          </a>
      </div>

      <!-- Filtros -->
      <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
          <form method="GET" action="verClientes.php" class="flex flex-col md:flex-row gap-4 items-end">
          <div class="w-full md:w-1/3">
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Buscar cliente
              </label>
              <input
              type="text"
              name="search"
              placeholder="Nombre de la empresa"
              class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                  dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
          </div>
          <div class="w-full md:w-1/3">
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Estado del cliente
              </label>
              <select name="estado" class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600
                  dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-custom-blue">
              <option value="">Todos</option>
              <option value="activo">Activo</option>
              <option value="inactivo">Inactivo</option>
              </select>
          </div>
          <button type="submit" class="w-full md:w-auto px-4 py-2 bg-custom-blue hover:bg-custom-blue-light text-white
              rounded-md transition-colors duration-200">
              Buscar
          </button>
          </form>
      </div>

      <!-- Lista de Clientes Desplegable -->
      <div class="max-w-7xl mx-auto">
          <?php foreach ($clientes as $cliente): ?>
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-4">
              <button onclick="toggleCliente('cliente<?php echo $cliente['id']; ?>')"
                      class="w-full px-6 py-4 flex justify-between items-center text-left text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                  <div class="flex items-center">
                      <span class="text-lg font-semibold"><?php echo $cliente['nombre_empresa']; ?></span>
                    
                      <?php if ($cliente['intentos'] == 3): ?>
                      <span class="ml-3 px-2 py-1 text-sm bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded-full">
                          Usuario Bloqueado
                      </span>
                      <?php else: ?>
                        <span class="ml-3 px-2 py-1 text-sm bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full">
                            Activo
                        </span>
                        <?php endif; ?>

                  </div>
                  <svg id="arrow-cliente<?php echo $cliente['id']; ?>" class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                  </svg>
              </button>

              <div id="info-cliente<?php echo $cliente['id']; ?>" class="hidden p-6 border-t border-gray-200 dark:border-gray-700">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <!-- Información de la Empresa -->
                      <div>
                          <p class="text-sm text-gray-600 dark:text-gray-400">RIF</p>
                          <p class="text-lg text-gray-900 dark:text-white"><?php echo $cliente['rif']; ?></p>
                      </div>
                      <div>
                          <p class="text-sm text-gray-600 dark:text-gray-400">Teléfono Empresa</p>
                          <p class="text-lg text-gray-900 dark:text-white"><?php echo $cliente['telefono_empresa']; ?></p>
                      </div>
                      <div class="md:col-span-2">
                          <p class="text-sm text-gray-600 dark:text-gray-400">Dirección de la Sede</p>
                          <p class="text-lg text-gray-900 dark:text-white"><?php echo $cliente['direccion']; ?></p>
                      </div>

                      <!-- Información del Contacto Principal -->
                      <div class="md:col-span-2 mt-4">
                          <h3 class="text-lg font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">
                              Información del Contacto Principal
                          </h3>
                      </div>
                      <div>
                          <p class="text-sm text-gray-600 dark:text-gray-400">Nombre Completo</p>
                          <p class="text-lg text-gray-900 dark:text-white"><?php echo $cliente['nombre_encargado']; ?></p>
                      </div>
                      <div>
                          <p class="text-sm text-gray-600 dark:text-gray-400">Cédula</p>
                          <p class="text-lg text-gray-900 dark:text-white"><?php echo $cliente['cedula_encargado']; ?></p>
                      </div>
                      <div>
                          <p class="text-sm text-gray-600 dark:text-gray-400">Teléfono Móvil</p>
                          <p class="text-lg text-gray-900 dark:text-white"><?php echo $cliente['telefono_encargado']; ?></p>
                      </div>

                      <!-- Botones de acción -->
                      <div class="flex items-end justify-end md:col-span-2">
                          <div class="flex space-x-2">
                              <a href="editar-cliente.php?id=<?php echo $cliente['id']; ?>"
                                 class="text-yellow-500 hover:text-yellow-600 dark:text-yellow-400 dark:hover:text-yellow-300"
                                 title="Editar">
                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                  </svg>
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <?php endforeach; ?>
      </div>
  </main>

  <footer class="bg-custom-blue dark:bg-gray-800 text-white text-center py-4 fixed bottom-0 w-full text-sm">
      <p>&copy; 2025 Autorepuestos Johbri, C.A. - Todos los derechos reservados</p>
  </footer>

  <script>
      if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
          document.documentElement.classList.add('dark');
      }

      function toggleCliente(clienteId) {
          const info = document.getElementById('info-' + clienteId);
          const arrow = document.getElementById('arrow-' + clienteId);
          if (info.classList.contains('hidden')) {
              info.classList.remove('hidden');
              arrow.classList.add('rotate-180');
          } else {
              info.classList.add('hidden');
              arrow.classList.remove('rotate-180');
          }
      }
  </script>
</body>
</html>