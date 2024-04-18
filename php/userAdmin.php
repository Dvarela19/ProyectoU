<!DOCTYPE html>
<html lang="es-CR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCEM Admin</title>
    <link rel="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/user.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
            <nav class="navbar navbar-expand-md navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img src="/img/logo.jpg" alt=""></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarsExample01" aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mb-md-0">
                            <li class="nav-item">
                                <a class="nav-link" href="/perfil.html">Carreras</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#footer">Contactos</a>
                            </li>
                            <button class="Btn">
                                <div class="sign"><svg viewBox="0 0 512 512">
                                        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                        </path>
                                    </svg></div>
                                <a class="text" aria-current="page" href="javascript:void(0);" onclick="confirmarSalida()">Salir</a>
                            </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /Breadcrumb -->
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input id="searchBar" type="text" class="form-control" placeholder="Buscar..." aria-label="Buscar" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>



                <?php
                session_start();

                $servername = "72.167.58.89";
                $username = "Tercera";
                $password = "Dvarela1903";
                $dbname = "PruebaT";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Error en la conexión: " . $conn->connect_error);
                }

                // if (!isset($_SESSION['user_id'])) {
                //  header("Location: /login.html");
                // exit;
                // }

                function getStudent($conn, $id)
                {
                    $sql = "SELECT * FROM matricula WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    return $result->fetch_assoc();
                }

                function updateStudent($conn, $id, $nombre, $apellido, $correo, $telefono, $materia)
                {
                    $sql = "UPDATE matricula SET nombre = ?, apellido = ?, correo = ?, telefono = ?, materia = ? WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssssi", $nombre, $apellido, $correo, $telefono, $materia, $id);
                    $stmt->execute();
                    $stmt->close();
                }

                if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editar'])) {
                    $student_id = $_POST['student_id'];
                    $student = getStudent($conn, $student_id);
                    // Mostrar el formulario de edición
                    echo '<div class="col-md-6 mb-4">';
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="student_id" value="' . $student['id'] . '">';
                    echo '<input type="text" name="nombre" value="' . $student['nombre'] . '" required>';
                    echo '<input type="text" name="apellido" value="' . $student['apellido'] . '" required>';
                    echo '<input type="email" name="correo" value="' . $student['correo'] . '" required>';
                    echo '<input type="tel" name="telefono" value="' . $student['telefono'] . '" required>';
                    echo '<input type="text" name="materia" value="' . $student['materia'] . '" required>';
                    echo '<button type="submit" name="guardar" class="btn btn-sm btn-primary">Guardar</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<div class="row">';
                    echo '<div class="col-md-12">';
                    echo '<h2>Estudiantes Matriculados:</h2>';
                    echo '<table class="table table-bordered">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Nombre</th>';
                    echo '<th>Apellido</th>';
                    echo '<th>Correo</th>';
                    echo '<th>Telefono</th>';
                    echo '<th>Materia</th>';
                    echo '<th>Acciones</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody id="studentsTableBody">';

                    $sql = "SELECT * FROM matricula";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['nombre'] . '</td>';
                            echo '<td>' . $row['apellido'] . '</td>';
                            echo '<td>' . $row['correo'] . '</td>';
                            echo '<td>' . $row['telefono'] . '</td>';
                            echo '<td>' . $row['materia'] . '</td>';
                            echo '<td>';
                            echo '<form method="post" action="">';
                            echo '<input type="hidden" name="student_id" value="' . $row['id'] . '">';
                            echo '<button type="submit" name="editar" class="btn btn-sm btn-info" style="color: white;">Editar</button>';
                            echo ' <a href="?delete=' . $row['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este registro?\')">Eliminar</a>';
                            echo '</form>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6">No hay Estudiantes.</td></tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                    echo '</div>';
                }

                if (isset($_POST['guardar'])) {
                    $student_id = $_POST['student_id'];
                    $nombre_actualizado = $_POST['nombre'];
                    $apellido_actualizado = $_POST['apellido'];
                    $correo_actualizado = $_POST['correo'];
                    $telefono_actualizado = $_POST['telefono'];
                    $materia_actualizada = $_POST['materia'];

                    updateStudent($conn, $student_id, $nombre_actualizado, $apellido_actualizado, $correo_actualizado, $telefono_actualizado, $materia_actualizada);
                }

                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    $sql = "DELETE FROM matricula WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id);
                    if ($stmt->execute()) {
                        echo '<script>window.location.href = window.location.href;</script>';
                    }
                    $stmt->close();
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div id="container-footer" class="container"><!----></div>
    <script src="/footer.js"></script>
    <script src="https://kit.fontawesome.com/fb0425b0f5.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchBar = document.querySelector('#searchBar');
            const studentsTableBody = document.querySelector('#studentsTableBody');

            searchBar.addEventListener('input', function() {
                const searchText = searchBar.value.trim().toLowerCase();
                const rows = studentsTableBody.querySelectorAll('tr');

                rows.forEach(row => {
                    const studentData = row.textContent.toLowerCase();
                    if (studentData.includes(searchText)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <script>
        function confirmarSalida() {
            if (confirm("¿Estás seguro de que deseas salir?")) {
                // Si el usuario confirma la salida, redirige a un archivo PHP para cerrar sesión
                window.location.href = "/php/cerrar_sesion.php";
            } else {
                // Si el usuario cancela la salida, no se hace nada
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#estudiantesTable').DataTable();
        });
    </script>


</body>

</html>