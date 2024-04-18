<?php
// Inicia la sesión PHP
session_start();

// Destruye todas las variables de sesión
session_destroy();

// Redirige al archivo de inicio de sesión o a cualquier otra página que desees mostrar después de cerrar sesión
header("Location: /index.html");
exit;
?>
