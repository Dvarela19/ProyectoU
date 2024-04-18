<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $user= $_POST['user'];
  $password = $_POST['password'];

  $db_host = '72.167.58.89';
  $db_user = 'Tercera';
  $db_pass = 'Dvarela1903';
  $db_name = 'PruebaT';
  $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

  if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
  }

  $query = "SELECT idusuario, user, password FROM usuario WHERE user = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $user);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id, $dbuser, $dbPassword);
    $stmt->fetch();

    if (password_verify($password, $dbPassword)) {

      $_SESSION['idusuario'] = $user_id; // Almacenar el id del usuario en la sesión
      $_SESSION['user'] = $correo;
      header('Location: /php/userAdmin.php'); // Redirigir al usuario a perfil.php
      exit;
    } else {
      echo "Contraseña incorrecta";
    }
  } else {
    echo "Usuario no encontrado";
  }

  $stmt->close();
  $conn->close();
}
