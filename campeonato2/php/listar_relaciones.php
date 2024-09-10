<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Consulta para obtener las relaciones entre jugadores, posiciones y equipos
$sql = "
    SELECT jugador.nombre, jugador.paterno, jugador.materno, posiciones.nombrePosicion, equipo.nombreEquipo 
    FROM rel_pos_ju
    INNER JOIN jugador ON rel_pos_ju.jugador_id = jugador.id
    INNER JOIN posiciones ON rel_pos_ju.posicion_id = posiciones.id
    INNER JOIN equipo ON jugador.codEquipo = equipo.codEquipo
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Relaciones Jugador-Posición-Equipo</title>
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
    <h2>Lista de Relaciones entre Jugadores, Posiciones y Equipos</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre del Jugador</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Posición</th>
                <th>Equipo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Comprobar si se encontraron resultados
            if ($result->num_rows > 0) {
                // Mostrar los datos de cada relación
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["paterno"] . "</td>";
                    echo "<td>" . $row["materno"] . "</td>";
                    echo "<td>" . $row["nombrePosicion"] . "</td>";
                    echo "<td>" . $row["nombreEquipo"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay relaciones registradas</td></tr>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
