<?php

require '../logica/validar.php';
require '../logica/conexionbdd.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('location:../login-sesion/loginCliente.php?error_message=Por favor inicie sesión');
    exit();
} else {
    if ((time() - $_SESSION['time']) > 600) {
        session_unset();
        session_destroy();
        header('location:../login-sesion/loginCliente.php?error_message=La sesión ha expirado');
        exit();
    }
}

$_SESSION['time'] = time();

$client_id = $_SESSION['id'];
$query = "SELECT nombre_empresa, nombre_encargado, rif FROM clientes WHERE id = ?";

$stmt = $conn->prepare($query);
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
    <title>Panel de Cliente - Autorepuestos Johbri</title>
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
        .carousel-container {
            position: relative;
            overflow: hidden;
        }

        .carousel-slides {
            position: relative;
            height: 500px;
        }

        .carousel-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .carousel-slide.active {
            opacity: 1;
        }

        .carousel-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-indicator {
            transition: all 0.3s ease;
        }

        .carousel-indicator.active {
            transform: scale(1.2);
            background-color: white;
        }

        .carousel-button {
            transition: all 0.3s ease;
            opacity: 0.7;
        }

        .carousel-button:hover {
            transform: scale(1.1);
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-custom-blue dark:bg-gray-800 text-white px-6 py-4 fixed w-full top-0 z-50 shadow-lg">
        <div class="flex justify-between items-center">

        <div class="text-xl font-bold">Autorepuestos Johbri, C.A.</div>
            <div class="text-xl font-bold"> <?php echo htmlspecialchars($client_data['nombre_empresa']) . "     " . htmlspecialchars($client_data['rif']); ?></div>
            <div class="flex items-center gap-4">
                <span class="text-sm bg-blue-900 px-3 py-1 rounded-full">Bienvenido, <?php echo htmlspecialchars($client_data['nombre_encargado']); ?></span>
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

    <!-- Sidebar -->
    <div class="fixed left-0 top-16 h-full w-64 bg-white dark:bg-gray-800 shadow-lg">
        <div class="p-4">
            <nav class="space-y-2">
                <a href="#dashboard" class="block px-4 py-2 rounded-lg bg-custom-blue text-white hover:bg-custom-blue-light transition-colors">
                    Dashboard
                </a>
                <div class="space-y-1">
                    <div class="px-4 py-2 text-sm font-semibold text-gray-600 dark:text-white">Mi Cuenta</div>
                    <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors dark:text-gray-400">
                        Mis Compras
                    </a>
                    <a href="catalogo.php" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors dark:text-gray-400">
                        Catálogo de Productos
                    </a>
                    <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 transition-colors">
                        Facturas
                    </a>
                    <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 transition-colors">
                        Reclamos
                    </a>
                    <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 transition-colors">
                        Consultas
                    </a>
                    <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 transition-colors">
                        Mis Datos
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Contenido Principal -->
    <main class="ml-64 pt-24 px-6 pb-20">
        <!-- Showcase Principal -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-6">
            <div class="flex flex-col md:flex-row">
                <!-- Imagen Principal -->
                <div class="relative w-full md:w-2/3">
                    <div class="carousel-container relative">
                        <div class="carousel-slides">
                            <div class="carousel-slide active">
                                <img src="img" alt="Lubricantes" class="w-full h-[500px] object-cover">
                            </div>
                            <div class="carousel-slide">
                                <img src="" alt="Filtros de Aceite" class="w-full h-[500px] object-cover">
                            </div>
                            <div class="carousel-slide">
                                <img src="" alt="Repuestos Originales" class="w-full h-[500px] object-cover">
                            </div>
                        </div>
                        <!-- Controles del Carousel -->
                        <button class="carousel-button absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button class="carousel-button absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <!-- Indicadores -->
                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                            <button class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all"></button>
                            <button class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all"></button>
                            <button class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all"></button>
                        </div>
                    </div>
                </div>

                <!-- Información del Producto -->
                <div class="w-full md:w-1/3 p-8">
                    <div class="sticky top-24">
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Wolf Lubricantes</h1>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                            <span class="ml-2 text-gray-600 dark:text-gray-400">(150 reseñas)</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            descripcion producto
                        </p>
                        <div class="mb-6">
                            <span class="text-3xl font-bold text-custom-blue dark:text-blue-400">$45.99</span>
                            <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">USD</span>
                        </div>
                        <div class="space-y-4">
                            <button class="w-full bg-custom-blue text-white py-3 px-6 rounded-lg hover:bg-custom-blue-light transition-colors">
                                Agregar al Carrito
                            </button>
                            <button class="w-full border-2 border-custom-blue text-white dark:text-white py-3 px-6 rounded-lg hover:bg-custom-blue hover:text-white transition-colors">
                                Ver más detalles
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Catálogo de Productos -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Catálogo de Productos</h3>
                    <div class="flex gap-2">
                        <input type="text" placeholder="Buscar productos..." class="px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <button class="bg-custom-blue text-white px-4 py-2 rounded-lg hover:bg-custom-blue-light transition-colors">
                            Buscar
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Producto 1 -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                    <img src="../assets/img/repuesto1.jpg" alt="Filtro de Aceite" class="w-full h-40 object-cover rounded-lg mb-2">
                    <h3 class="font-semibold text-gray-800 dark:text-white">Filtro de Aceite</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Código: ABC123</p>
                    <p class="text-lg font-bold text-custom-blue dark:text-blue-400 mt-2">$25.99</p>
                    <button class="w-full mt-2 bg-custom-blue text-white py-2 rounded hover:bg-custom-blue-light transition-colors">
                        Agregar al carrito
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        // modo oscuro
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }

        // carrusel (que la imagen se cambie sola)
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.carousel-slide');
            const indicators = document.querySelectorAll('.carousel-indicator');
            const prevButton = document.querySelector('.carousel-button.left-4');
            const nextButton = document.querySelector('.carousel-button.right-4');
            let currentSlide = 0;
            const slideCount = slides.length;

            // Initialize first slide
            slides[0].classList.add('active');
            indicators[0].classList.add('active');

            // Function to update indicators
            function updateIndicators() {
                indicators.forEach((indicator, index) => {
                    if (index === currentSlide) {
                        indicator.classList.add('active');
                    } else {
                        indicator.classList.remove('active');
                    }
                });
            }

            // Function to show specific slide
            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                slides[index].classList.add('active');
                updateIndicators();
            }

            // Function to show next slide
            function nextSlide() {
                currentSlide = (currentSlide + 1) % slideCount;
                showSlide(currentSlide);
            }

            // Function to show previous slide
            function prevSlide() {
                currentSlide = (currentSlide - 1 + slideCount) % slideCount;
                showSlide(currentSlide);
            }

            // Event listeners for buttons
            prevButton.addEventListener('click', () => {
                clearInterval(autoSlideInterval);
                prevSlide();
            });

            nextButton.addEventListener('click', () => {
                clearInterval(autoSlideInterval);
                nextSlide();
            });

            // Event listeners for indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    clearInterval(autoSlideInterval);
                    currentSlide = index;
                    showSlide(currentSlide);
                });
            });

            // Auto-advance slides every 5 seconds
            const autoSlideInterval = setInterval(nextSlide, 5000);

            // Pause auto-advance on hover
            const carouselContainer = document.querySelector('.carousel-container');
            carouselContainer.addEventListener('mouseenter', () => {
                clearInterval(autoSlideInterval);
            });

            carouselContainer.addEventListener('mouseleave', () => {
                autoSlideInterval = setInterval(nextSlide, 5000);
            });
        });
    </script>
</body>
</html>