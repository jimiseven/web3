<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $jugador_id = $_POST['jugador_id'];
    $posicion_id = $_POST['posicion_id'];

    // Consulta para insertar la relación entre jugador y posición en la base de datos
    $sql = "INSERT INTO rel_pos_ju (jugador_id, posicion_id) 
            VALUES ('$jugador_id', '$posicion_id')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Relación registrada exitosamente";
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
    <title>Registrar Relación Jugador-Posición</title>
</head>
<body>
    <h2>Registrar Relación entre Jugador y Posición</h2>

    <!-- Mostrar mensaje de éxito o error -->
    <?php if (!empty($mensaje)): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form action="registrar_relacion.php" method="post">
        <label for="jugador_id">Seleccionar Jugador:</label>
        <select name="jugador_id" required>
            <?php
            // Consulta para obtener los jugadores
            $result_jugadores = $conn->query("SELECT id, nombre, paterno FROM jugador");
            if ($result_jugadores->num_rows > 0) {
                while ($row = $result_jugadores->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['nombre']} {$row['paterno']}</option>";
                }
            } else {
                echo "<option value=''>No hay jugadores registrados</option>";
            }
            ?>
        </select><br><br>

        <label for="posicion_id">Seleccionar Posición:</label>
        <select name="posicion_id" required>
            <?php
            // Consulta para obtener las posiciones
            $result_posiciones = $conn->query("SELECT id, nombrePosicion FROM posiciones");
            if ($result_posiciones->num_rows > 0) {
                while ($row = $result_posiciones->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['nombrePosicion']}</option>";
                }
            } else {
                echo "<option value=''>No hay posiciones registradas</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Registrar Relación">
    </form>
</body>
</html>
