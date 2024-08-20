<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jugador</title>
</head>
<body>
    <h1>Editar Jugador</h1>
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

    $id = $_GET['id'];

    // Obtener datos del jugador a editar
    $query = "SELECT * FROM jugador WHERE cod_j = $id";
    $result = $conn->query($query);
    $jugador = $result->fetch_assoc();

    // Obtener los equipos
    $query_equipos = "SELECT codEquipo, nombreEquipo FROM equipo";
    $result_equipos = $conn->query($query_equipos);
    ?>

    <form action="guardarEditarJugador.php" method="POST">
        <input type="hidden" name="cod_j" value="<?php echo $jugador['cod_j']; ?>">

        Cédula de Identidad: <input type="text" name="ci" value="<?php echo $jugador['ci']; ?>"><br>
        Nombre: <input type="text" name="nombre" value="<?php echo $jugador['nombre']; ?>"><br>
        Apellido Paterno: <input type="text" name="paterno" value="<?php echo $jugador['paterno']; ?>"><br>
        Apellido Materno: <input type="text" name="materno" value="<?php echo $jugador['materno']; ?>"><br>
        Fecha de Nacimiento: <input type="date" name="fechaNac" value="<?php echo $jugador['fechaNac']; ?>"><br>
        Sexo:
        <input type="radio" name="sexo" value="Hombre" <?php echo ($jugador['sexo'] == 'Hombre') ? 'checked' : ''; ?>> Hombre
        <input type="radio" name="sexo" value="Mujer" <?php echo ($jugador['sexo'] == 'Mujer') ? 'checked' : ''; ?>> Mujer<br>
        Equipo:
        <select name="codEquipo">
            <?php while($row = $result_equipos->fetch_assoc()): ?>
                <option value="<?php echo $row['codEquipo']; ?>" <?php echo ($row['codEquipo'] == $jugador['codEquipo']) ? 'selected' : ''; ?>>
                    <?php echo $row['nombreEquipo']; ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>
        <input type="submit" value="Guardar Cambios">
        <button><a href="../index.html">Cancelar</a></button> 
    </form>
</body>
</html>

