<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Consulta para obtener todos los jugadores registrados
$sql = "SELECT cod_j, ci, nombre, paterno, materno, fechaNac, sexo, codEquipo FROM jugador";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Jugadores</title>
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
    <h2>Lista de Jugadores Registrados</h2>

    <table>
        <thead>
            <tr>
                <th>Código del Jugador</th>
                <th>Carnet de Identidad</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Fecha de Nacimiento</th>
                <th>Sexo</th>
                <th>Código del Equipo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Comprobar si se encontraron resultados
            if ($result->num_rows > 0) {
                // Mostrar los datos de cada jugador
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["cod_j"] . "</td>";
                    echo "<td>" . $row["ci"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["paterno"] . "</td>";
                    echo "<td>" . $row["materno"] . "</td>";
                    echo "<td>" . $row["fechaNac"] . "</td>";
                    echo "<td>" . $row["sexo"] . "</td>";
                    echo "<td>" . $row["codEquipo"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No hay jugadores registrados</td></tr>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
