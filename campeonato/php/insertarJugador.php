<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Jugador</title>
</head>
<body>
    <h1>Insertar Nuevo Jugador</h1>
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

    // Consulta para obtener los equipos
    $query = "SELECT codEquipo, nombreEquipo FROM equipo";  // Usando los nombres correctos de las columnas
    $result = $conn->query($query);
    ?>

    <form action="guardarJugador.php" method="POST">
        Cédula de Identidad: <input type="text" name="ci"><br>
        Nombre: <input type="text" name="nombre"><br>
        Apellido Paterno: <input type="text" name="paterno"><br>
        Apellido Materno: <input type="text" name="materno"><br>
        Fecha de Nacimiento: <input type="date" name="fechaNac"><br>
        Sexo:
        <input type="radio" name="sexo" value="Hombre"> Hombre
        <input type="radio" name="sexo" value="Mujer"> Mujer<br>
        Equipo:
        <select name="codEquipo">
            <?php while($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['codEquipo']; ?>"><?php echo $row['nombreEquipo']; ?></option>
            <?php endwhile; ?>
        </select><br><br>
        <input type="submit" value="Guardar">
        <button><a href="../index.html">Cancelar</a></button> 
    </form>
</body>
</html>
