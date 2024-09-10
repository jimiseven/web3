<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Consulta para obtener todos los equipos registrados
$sql = "SELECT codEquipo, nombreEquipo, fechaCreacion, color FROM equipo";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Equipos</title>
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
    <h2>Lista de Equipos Registrados</h2>

    <table>
        <thead>
            <tr>
                <th>Código del Equipo</th>
                <th>Nombre del Equipo</th>
                <th>Fecha de Creación</th>
                <th>Color</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Comprobar si se encontraron resultados
            if ($result->num_rows > 0) {
                // Mostrar los datos de cada equipo
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["codEquipo"] . "</td>";
                    echo "<td>" . $row["nombreEquipo"] . "</td>";
                    echo "<td>" . $row["fechaCreacion"] . "</td>";
                    echo "<td>" . $row["color"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay equipos registrados</td></tr>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
