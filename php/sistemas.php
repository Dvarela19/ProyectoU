<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ucem Materias</title>
    <link rel="icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/login.css">
    <!--Librerias-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Agregar estilos para filas y columnas de tabla -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 800px;
        }

        tr.table-row-divider {
            border-bottom: 1px solid #ccc;
            background-color: white;
        }

        th,
        td {
            border: 1px solid #ccc;
        }

        th {
            background-color: white;
        }

        h1 {
            font-style: italic;
        }

        /* Estilo para el botón Guardar */
        #boton-guardar {
            margin-bottom: 20px;
            background-color: green;
            color: white;

        }

        .titulo-materias {
            color: white;
            font-style: italic;
        }
    </style>
</head>

<body>

    <h1 class="titulo-materias">Materias Sistemas</h1>
    <table id="tabla-materias" border="1" style="margin: 0 auto;">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Materia</th>
                <th>Creditos</th>
                <th>Requisitos</th>
                <th>Seleccionar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            include 'info_sistemas.php';


            $sql_ad = "SELECT codigo, materia, creditos, requisitos FROM sistemas;";
            $result_ad = $conn->query($sql_ad);

            // Verificar si hay filas en el resultado
            if ($result_ad->num_rows > 0) {
                // Mostrar datos en la tabla
                while ($row = $result_ad->fetch_assoc()) {
                    echo '<tr class="table-row-divider">';
                    echo '<td>' . $row["codigo"] . '</td>';
                    echo '<td>' . $row["materia"] . '</td>';
                    echo '<td>' . $row["creditos"] . '</td>';
                    echo '<td>' . $row["requisitos"] . '</td>';
                    echo '<td><input type="checkbox" name="seleccionar[]" value="' . $row["materia"] . '"></td>';
                    echo '</tr>';
                }
            } else {
                // Mostrar mensaje si no hay datos en la tabla
                echo '<tr>';
                echo '<td colspan="5">No hay datos en la tabla.</td>';
                echo '</tr>';
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </tbody>
    </table>

    <button id="boton-guardar" onclick="guardarTabla()">Registrar <a href="/users.php"></a></button>

    <!-- Scripts y librerías JavaScript -->
    <script>
        function guardarTabla() {
            const checkboxes = document.querySelectorAll('input[name="seleccionar[]"]:checked');

            const seleccionados = [];
            checkboxes.forEach(checkbox => {
                seleccionados.push(checkbox.value);
            });

            // Envía el array de valores seleccionados al script PHP en el servidor mediante AJAX
            $.ajax({
                url: '/php/checkbox_sistemas.php', // Reemplaza por la ruta correcta a tu script PHP
                method: 'POST',
                data: {
                    seleccionados: seleccionados
                },
                success: function(response) {

                    alert(response);
                    // Redirige a users.html después de guardar los datos
                    window.location.href = '/users.php';
                },
                error: function(error) {
                    // Maneja errores si ocurrieron durante la solicitud
                    console.error(error);
                }
            });
        }
    </script>
</body>

</html>