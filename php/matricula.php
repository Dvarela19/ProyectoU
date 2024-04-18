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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario y limpiarlos
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $materiaSeleccionada = isset($_POST['materia']) ? $_POST['materia'] : '';

    // Validar los datos (ejemplo: verificar que el campo "correo" no esté vacío)
    if (empty($correo)) {
        die("Error: El campo 'correo' no puede estar vacío.");
    }

    // Encriptar la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Verificar si se ha seleccionado una materia
    if (empty($materiaSeleccionada)) {
        die("Error: Por favor, seleccione una materia.");
    }

    // Consulta preparada
    $sql = "INSERT INTO matricula (nombre, apellido, correo, telefono, materia, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("ssssss", $nombre, $apellido, $correo, $telefono, $materiaSeleccionada, $hashedPassword);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Devolver el valor de la redirección según la materia seleccionada
        echo $materiaSeleccionada === "administracion" ? "/php/administracion.php" :
             ($materiaSeleccionada === "contabilidad" ? "/php/contabilidad.php" :
             ($materiaSeleccionada === "industrial" ? "/php/industrial.php" :
             ($materiaSeleccionada === "sistemas" ? "/php/sistemas.php" : "seleccionarMateria.html")));
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
