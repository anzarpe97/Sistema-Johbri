<?php

        session_start();
        
        if (!isset($_SESSION['id'])) {
            header('Location: ../login-sesion/login.php');
            exit();
        }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
</head>
<body>
    
<h1><i class="ri-git-repository-commits-line"></i></h1>

</body>
</html>