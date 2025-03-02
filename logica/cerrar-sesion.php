<?php

session_start();
session_unset();
session_destroy();


header("Location: ../login-sesion/login.php");
exit();


?>