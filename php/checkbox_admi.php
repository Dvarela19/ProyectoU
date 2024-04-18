<?php
if (isset($_POST['seleccionados']) && is_array($_POST['seleccionados'])) {
    // Obtiene los nombres de las materias seleccionadas desde la solicitud AJAX
    $seleccionados = $_POST['seleccionados'];

    // Conecta con tu base de datos (modifica los detalles de conexión según sea necesario)
    $servername = "72.167.58.89";
    $username = "Tercera";
    $password = "Dvarela1903";
    $dbname = "PruebaT";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Codificación de caracteres UTF-8
    $conn->set_charset("utf8mb4");

    // Escapa los nombres de las materias seleccionadas para evitar inyección SQL (opcional, pero recomendado)
    $seleccionados_escaped = array_map(function ($value) use ($conn) {
        return $conn->real_escape_string($value);
    }, $seleccionados);

    // Crea una cadena con los nombres de las materias seleccionadas separados por comas
    $seleccionados_str = implode(', ', $seleccionados_escaped);

    // Verificar si ya existen registros con las materias seleccionadas
    $sql_select = "SELECT nombre_materia FROM estudianteAdmi WHERE nombre_materia IN ('$seleccionados_str')";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        // Mostrar un mensaje de error si algunas materias ya existen en la base de datos
        echo "Error: Las siguientes materias ya están guardadas: ";
        $existing_materias = [];
        while ($row = $result->fetch_assoc()) {
            $existing_materias[] = $row['nombre_materia'];
        }
        echo implode(', ', $existing_materias);
    } else {
        // Insertar los nombres de las materias en la base de datos
        $sql_insert = "INSERT INTO estudianteAdmi (nombre_materia) VALUES ('$seleccionados_str')";
        if ($conn->query($sql_insert) === TRUE) {
            // Inserción exitosa, redirige a users.html
            echo "Materias Guardadas";
            header('Location: /users.php');
            exit;
        } else {
            // Error en la inserción
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }

    // Cierra la conexión a la base de datos
    $conn->close();
} else {
    // Mostrar un mensaje de error si no se recibieron datos válidos
    echo "Error: Datos inválidos recibidos.";
}
?>
