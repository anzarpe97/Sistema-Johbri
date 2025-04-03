<?php
require '../logica/validar.php';
require '../logica/conexionbdd.php';

session_start();

if (!isset($_SESSION['id'])) {
  header('location:../login-sesion/loginCliente.php?error_message=Por favor inicie sesión');
  exit();
}

$client_id = $_SESSION['id'];
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre_encargado = trim($_POST['nombre_encargado']);
  $correo = trim($_POST['correo']);
  $contrasena = trim($_POST['contrasena']);
  $cedula_encargado = trim($_POST['cedula_encargado']);

  if (!empty($nombre_encargado) && !empty($correo)) {
    $query = "UPDATE clientes SET nombre_encargado = ?, correo = ?, cedula_encargado = ?";
    $params = [$nombre_encargado, $correo, $cedula_encargado];
    $types = "sss";

    // Only update password if a new one is provided
    if (!empty($contrasena)) {
      $query .= ", contrasena = ?";
      $params[] = $contrasena;
      $types .= "s";
    }

    $query .= " WHERE id = ?";
    $params[] = $client_id;
    $types .= "i";

    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
      $message = '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">Datos actualizados correctamente</div>';
    } else {
      $message = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">Error al actualizar los datos</div>';
    }
  }
}

// Get client data
$stmt = $conn->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();
$client_data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es" class="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Datos - Autorepuestos Johbri</title>
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
        <a href="./cliente.php" class="text-xl hover:text-gray-200 transition-colors duration-200 flex items-center gap-2">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
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
                        <a href="../assets/docs/MANUAL DE USUARIO (CLIENTE) (1).pdf" target="_blank" class="block px-4 py-2 text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600 rounded-b-lg">
                            Manual de Usuario Cliente
                        </a>
                    </div>
              </div>
        <button
          onclick="document.documentElement.classList.toggle('dark')"
          class="p-2 rounded-full bg-gray-700 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-700 transition-colors duration-200">
          <span class="dark:hidden">🌙</span>
          <span class="hidden dark:inline">☀️</span>
        </button>
        <a href="../logica/cerrar-sesion.php" class="hover:underline">Cerrar Sesión</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="pt-24 px-6 pb-20 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 dark:text-white">Mis Datos</h2>

    <?php echo $message; ?>

    <form method="POST" class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
      <!-- Company Information (Read-only) -->
      <div class="mb-6">
        <h3 class="text-lg font-semibold mb-4 dark:text-white">Datos de la Empresa</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de la Empresa</label>
            <div class="relative">
              <input type="text" value="<?php echo htmlspecialchars($client_data['nombre_empresa']); ?>"
                class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 dark:text-white rounded-md pr-10" readonly>
              <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">🔒</span>
            </div>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">RIF</label>
            <div class="relative">
              <input type="text" value="<?php echo htmlspecialchars($client_data['rif']); ?>"
                class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 dark:text-white rounded-md pr-10" readonly>
              <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">🔒</span>
            </div>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Teléfono Empresa</label>
            <div class="relative">
              <input type="text" value="<?php echo htmlspecialchars($client_data['telefono_empresa']); ?>"
                class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 dark:text-white rounded-md pr-10" readonly>
              <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">🔒</span>
            </div>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dirección</label>
            <div class="relative">
              <input type="text" value="<?php echo htmlspecialchars($client_data['direccion']); ?>"
                class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 dark:text-white rounded-md pr-10" readonly>
              <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">🔒</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Editable Information -->
      <div class="mb-6">
        <h3 class="text-lg font-semibold mb-4 dark:text-white">Datos del Encargado</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre del Encargado</label>
            <input type="text" name="nombre_encargado" value="<?php echo htmlspecialchars($client_data['nombre_encargado']); ?>"
              class="w-full px-3 py-2 border border-transparent dark:border-transparent rounded-md dark:bg-gray-700 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 transition-colors duration-200">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cédula</label>
            <input type="text" name="cedula_encargado" value="<?php echo htmlspecialchars($client_data['cedula_encargado']); ?>"
              class="w-full px-3 py-2 border border-transparent dark:border-transparent rounded-md dark:bg-gray-700 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 transition-colors duration-200">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Correo Electrónico</label>
            <input type="email" name="correo" value="<?php echo htmlspecialchars($client_data['correo']); ?>"
              class="w-full px-3 py-2 border border-transparent dark:border-transparent rounded-md dark:bg-gray-700 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 transition-colors duration-200">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nueva Contraseña (opcional)</label>
            <input type="password" name="contrasena" placeholder="Dejar en blanco para mantener la actual"
              class="w-full px-3 py-2 border border-transparent dark:border-transparent rounded-md dark:bg-gray-700 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 transition-colors duration-200">
          </div>
        </div>
      </div>

      <div class="flex justify-end">
        <button type="submit"
          class="bg-custom-blue hover:bg-custom-blue-light text-white px-6 py-2 rounded-md transition-colors duration-200">
          Guardar Cambios
        </button>
      </div>
    </form>
  </main>

  <footer class="bg-custom-blue dark:bg-gray-800 text-white text-center py-4 fixed bottom-0 w-full text-sm">
    <p>&copy; 2025 Autorepuestos Johbri, C.A. - Todos los derechos reservados</p>
  </footer>
</body>

</html>