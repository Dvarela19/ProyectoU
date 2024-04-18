<!DOCTYPE html>
<html lang="es-CR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuario</title>
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
        <?php
        // Iniciamos la sesión PHP para poder utilizar variables de sesión
        session_start();

        // Verificamos si el usuario ha iniciado sesión
        if (!isset($_SESSION['user_id'])) {
          // Si el usuario no ha iniciado sesión, redirigimos a la página de inicio de sesión
          header("Location: /login.html");
          exit;
        }

        // Conexión a la base de datos
        $servername = "72.167.58.89";
        $username = "Tercera";
        $password = "Dvarela1903";
        $dbname = "PruebaT";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
          die("Error en la conexión: " . $conn->connect_error);
        }

        // Obtener el ID del usuario que ha iniciado sesión desde la sesión PHP
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT nombre, apellido, correo FROM matricula WHERE id = $user_id";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $nombre = $row["nombre"];
          $apellido = $row["apellido"];
          $correo = $row["correo"];

          // Agregar la etiqueta <img> con la ruta de la foto estática
          echo '<div class="card mb-3">';
          echo '<div class="card-body">';
          echo '<div class="row">';
          echo '<div class="col-sm-3">';
          echo '<img src="/img/perfilA.png" alt="Foto del usuario" width="100">';
          echo '</div>';
          // Mostrar el nombre al costado de la foto
          echo '<div class="col-sm-9">';
          echo '<h6 class="mb-0">Nombre</h6>';
          echo '<h6 class="mb-0">' . $nombre . ' ' . $apellido . '</h6>';
          echo '</div>';
          echo '</div>';
          echo '<hr>';
          echo '<div class="row">';
          echo '<div class="col-sm-3">';
          echo '<h6 class="mb-0">Correo</h6>';
          echo '</div>';
          echo '<div class="col-sm-9">';
          echo '<h6 class="mb-0">' . $correo . '</h6>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        } else {
          echo "No se encontraron registros.";
        }


        ?>


      </div>
    </div>



    <?php



    $sql_materias = "SELECT nombre_materia FROM estudianteSistemas";

    $result_materias = $conn->query($sql_materias);
    ?>

    <div class="col-md-8">

      <?php
      if ($result_materias->num_rows > 0) {
        echo '<h3>Materias Registradas</h3>';
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Nombre Materia</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row_materia = $result_materias->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $row_materia["nombre_materia"] . '</td>';
          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
      } else {
        echo "<p>No se encontraron materias registradas.</p>";
      }


      $conn->close();
      ?>
    </div>

  </div>
  </div>
  </div>

  <div id="container-footer" class="container"><!----></div>
  <script src="/footer.js"></script>
  <script src="https://kit.fontawesome.com/fb0425b0f5.js" crossorigin="anonymous"></script>

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
</body>

</html>