<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombrePosicion = $_POST['nombrePosicion'];
    $descripcion = $_POST['descripcion'];

    // Consulta para insertar una nueva posición en la base de datos
    $sql = "INSERT INTO posiciones (nombrePosicion, descripcion) 
            VALUES ('$nombrePosicion', '$descripcion')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Posición registrada exitosamente";
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
    <title>Registro de Posición</title>
</head>
<body>
    <h2>Registrar Posición</h2>

    <!-- Mostrar mensaje de éxito o error -->
    <?php if (!empty($mensaje)): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form action="registrar_posicion.php" method="post">
        <label for="nombrePosicion">Nombre de la Posición:</label>
        <input type="text" name="nombrePosicion" required><br>

        <label for="descripcion">Descripción de la Posición:</label>
        <textarea name="descripcion" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Registrar Posición">
    </form>
</body>
</html>
