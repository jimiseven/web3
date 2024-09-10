<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Consulta para obtener todas las posiciones registradas
$sql = "SELECT nombrePosicion, descripcion FROM posiciones";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Posiciones</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Lista de Posiciones Registradas</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre de la Posición</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Comprobar si se encontraron resultados
            if ($result->num_rows > 0) {
                // Mostrar los datos de cada posición
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nombrePosicion"] . "</td>";
                    echo "<td>" . $row["descripcion"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No hay posiciones registradas</td></tr>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
