<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Florerías</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Listar Florerías</h1>

        <table class="table table-hover table-borderless">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Fecha de Creación</th>
                    <th>Localizacion</th>
                    <th>Eslogan</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Conexión a la base de datos
                $db = new mysqli('localhost', 'root', '', 'Floreria');

                // Comprobar la conexión
                if ($db->connect_error) {
                    die('Error de conexión: ' . $db->connect_error);
                }

                // Seleccionar datos de la tabla `floreria`
                $sql = "SELECT * FROM floreria";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    // Mostrar cada fila como una fila en la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['cod_floreria'] . "</td>";
                        echo "<td>" . $row['nombreFloreria'] . "</td>";
                        echo "<td>" . $row['fechaCreacion'] . "</td>";
                        echo "<td>" . $row['localizacion'] . "</td>";
                        echo "<td>" . $row['eslogan'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay florerías registradas</td></tr>";
                }

                // Cerrar la conexión
                $db->close();

                ?>
            </tbody>
        </table>
    </div>

    <br>
    <a href="index.html" class="btn btn-outline-primary d-block mx-auto">Insertar otra</a><br>
</body>
</html>

