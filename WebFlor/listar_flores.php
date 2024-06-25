<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de flores registradas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Listado de flores registradas</h1>

        <?php

        // Conexión a la base de datos
        $db = new mysqli('localhost', 'root', '', 'flores_v4');

        // Verificar la conexión
        if ($db->connect_error) {
            die('Error de conexión: ' . $db->connect_error);
        }

        // Consulta SQL para obtener los datos de las flores
        // $sql = "SELECT nombreFlor, cantidadCosecha, costo, fechaCosecha, t.nombreTipo AS tipoFlor, observacion FROM flores_v4 f JOIN tipos_flores t ON f.idTipo = t.idTipo";
        $sql = "SELECT * FROM flor";


        // Ejecutar la consulta SQL
        $result = $db->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre de la flor</th>
                        <th>Cantidad de cosecha</th>
                        <th>Costo</th>
                        <th>Fecha de cosecha</th>
                        <th>Tipo de flor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Recorrer los resultados y mostrarlos en la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['nombreFlor'] . '</td>';
                        echo '<td>' . $row['cantidadCosecha'] . '</td>';
                        echo '<td>' . $row['costo'] . '</td>';
                        echo '<td>' . $row['fechaCosecha'] . '</td>';
                        echo '<td>' . $row['nombreTipo'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo 'No hay flores registradas';
        }

        // Cerrar la conexión a la base de datos
        $db->close();

        ?>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
