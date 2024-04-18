<?php
$servername = "72.167.58.89";
$username = "Tercera";
$password = "Dvarela1903";
$dbname = "PruebaT";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>