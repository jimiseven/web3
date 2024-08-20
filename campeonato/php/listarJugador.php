<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Jugadores</title>
</head>
<body>
    <h1>Lista de Jugadores</h1>
    <hr color="orange" size="4">
    <br>

    <?php
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webCampeonato";  // Nombre de la base de datos

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener los jugadores y sus equipos
    $query = "SELECT j.cod_j, j.ci, j.nombre, j.paterno, j.materno, j.fechaNac, j.sexo, e.nombreEquipo 
              FROM jugador j 
              INNER JOIN equipo e ON j.codEquipo = e.codEquipo";
    $result = $conn->query($query);
    ?>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Cédula de Identidad</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha de Nacimiento</th>
            <th>Sexo</th>
            <th>Equipo</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['cod_j']; ?></td>
            <td><?php echo $row['ci']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['paterno']; ?></td>
            <td><?php echo $row['materno']; ?></td>
            <td><?php echo $row['fechaNac']; ?></td>
            <td><?php echo $row['sexo']; ?></td>
            <td><?php echo $row['nombreEquipo']; ?></td>
            <td>
                <a href="editarJugador.php?id=<?php echo $row['cod_j']; ?>">Editar</a>
                <a href="eliminarJugador.php?id=<?php echo $row['cod_j']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <button><a href="insertarJugador.php">Insertar Jugador</a></button>
    <button><a href="../index.html">Ir al inicio</a></button> 
</body>
</html>
