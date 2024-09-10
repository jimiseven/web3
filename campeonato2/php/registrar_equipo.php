<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $codEquipo = $_POST['codEquipo'];
    $nombreEquipo = $_POST['nombreEquipo'];
    $fechaCreacion = $_POST['fechaCreacion'];
    $color = $_POST['color'];

    // Consulta para insertar un nuevo equipo en la base de datos
    $sql = "INSERT INTO equipo (codEquipo, nombreEquipo, fechaCreacion, color) 
            VALUES ('$codEquipo', '$nombreEquipo', '$fechaCreacion', '$color')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Equipo registrado exitosamente";
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
    <title>Registro de Equipo</title>
</head>
<body>
    <h2>Registrar Equipo</h2>

    <!-- Mostrar mensaje de éxito o error -->
    <?php if (!empty($mensaje)): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form action="registrar_equipo.php" method="post">
        <label for="codEquipo">Código del Equipo:</label>
        <input type="text" name="codEquipo" required><br>

        <label for="nombreEquipo">Nombre del Equipo:</label>
        <input type="text" name="nombreEquipo" required><br>

        <label for="fechaCreacion">Fecha de Creación:</label>
        <input type="date" name="fechaCreacion" required><br>

        <label for="color">Color del Equipo:</label>
        <input type="text" name="color" required><br><br>

        <input type="submit" value="Registrar Equipo">
    </form>
</body>
</html>
