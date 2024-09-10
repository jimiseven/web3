<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $cod_j = $_POST['cod_j'];
    $ci = $_POST['ci'];
    $nombre = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $fechaNac = $_POST['fechaNac'];
    $sexo = $_POST['sexo'];
    $codEquipo = $_POST['codEquipo'];

    // Consulta para insertar un nuevo jugador en la base de datos
    $sql = "INSERT INTO jugador (cod_j, ci, nombre, paterno, materno, fechaNac, sexo, codEquipo) 
            VALUES ('$cod_j', '$ci', '$nombre', '$paterno', '$materno', '$fechaNac', '$sexo', '$codEquipo')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Jugador registrado exitosamente";
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Jugador</title>
</head>
<body>
    <h2>Registrar Jugador</h2>

    <!-- Mostrar mensaje de éxito o error -->
    <?php if (!empty($mensaje)): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form action="registrar_jugador.php" method="post">
        <label for="cod_j">Código del Jugador:</label>
        <input type="text" name="cod_j" required><br>

        <label for="ci">Carnet de Identidad:</label>
        <input type="text" name="ci" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="paterno">Apellido Paterno:</label>
        <input type="text" name="paterno" required><br>

        <label for="materno">Apellido Materno:</label>
        <input type="text" name="materno" required><br>

        <label for="fechaNac">Fecha de Nacimiento:</label>
        <input type="date" name="fechaNac" required><br>

        <label for="sexo">Sexo:</label>
        <select name="sexo" required>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select><br>

        <label for="codEquipo">Equipo:</label>
        <select name="codEquipo" required>
            <?php
            // Volver a abrir la conexión a la base de datos para obtener los equipos
            include 'conexion.php';

            // Consulta para obtener los equipos
            $result = $conn->query("SELECT codEquipo, nombreEquipo FROM equipo");
            
            // Llenar el select con los equipos
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['codEquipo']}'>{$row['nombreEquipo']}</option>";
                }
            } else {
                echo "<option value=''>No hay equipos disponibles</option>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </select><br><br>

        <input type="submit" value="Registrar Jugador">
    </form>
</body>
</html>
