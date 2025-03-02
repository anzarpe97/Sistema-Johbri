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