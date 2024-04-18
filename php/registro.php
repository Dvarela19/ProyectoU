<?php
  // Conectar a la base de datos
  $db_host = '72.167.58.89';
  $db_user = 'Tercera';
  $db_pass = 'Dvarela1903';
  $db_name = 'PruebaT';
  $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$user = $_POST['user'];

$password = $_POST['password'];

// Encriptar la contraseña
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Insertar el usuario en la base de datos
$sql = "INSERT INTO usuario (user, password) VALUES ('$user', '$hashedPassword')";
if ($conn->query($sql) === TRUE) {
    // Redireccionar al usuario a la página HTML de inicio de sesión
    header('Location: /login.html');
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
