<?php
include 'php/conexion.php'; // Incluir la conexión a la base de datos

// Obtener todas las tareas
$sql_tareas = "SELECT id, nombre FROM tareas";
$resultado_tareas = $conexion->query($sql_tareas);

// Obtener todos los equipos
$sql_equipos = "SELECT id, procesador, marca, unidades_disponibles FROM equipos WHERE unidades_disponibles > 0"; // Solo equipos con unidades disponibles
$resultado_equipos = $conexion->query($sql_equipos);

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tarea_id = $_POST['tarea_id'];
    $equipos_ids = $_POST['equipo_id']; // Esto ahora es un array de IDs de equipos

    // Empezar una transacción para garantizar la consistencia de los datos
    $conexion->beginTransaction();

    try {
        foreach ($equipos_ids as $equipo_id) {
            // Consulta SQL para asignar el equipo a la tarea
            $sql_asignar = "INSERT INTO tarea_equipo (tarea_id, equipo_id) VALUES (?, ?)";
            $stmt = $conexion->prepare($sql_asignar);

            // Vincular parámetros y ejecutar la consulta
            $stmt->bindParam(1, $tarea_id);
            $stmt->bindParam(2, $equipo_id);

            if ($stmt->execute()) {
                // Actualizar la tabla de equipos para disminuir el número de unidades
                $sql_actualizar = "UPDATE equipos SET unidades_disponibles = unidades_disponibles - 1 WHERE id = ?";
                $stmt_actualizar = $conexion->prepare($sql_actualizar);
                $stmt_actualizar->bindParam(1, $equipo_id);

                if (!$stmt_actualizar->execute()) {
                    throw new Exception("Error al actualizar las unidades del equipo.");
                }
            } else {
                throw new Exception("Error al asignar el equipo a la tarea.");
            }
        }

        // Si todo va bien, confirmar la transacción
        $conexion->commit();
        $mensaje = "Equipos asignados a la tarea exitosamente y se actualizaron las unidades.";
    } catch (Exception $e) {
        // Si algo falla, revertir la transacción
        $conexion->rollBack();
        $mensaje = "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Equipos a Tarea</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <div class="container">
        <div class="content">
            <h2 class="mb-0">Asignar Equipos a Tarea</h2>

            <?php if (isset($mensaje)): ?>
                <div class="alert alert-info"><?php echo $mensaje; ?></div>
            <?php endif; ?>

            <form method="post" action="asignar_equipo.php">
                <!-- Selección de la tarea -->
                <div class="mb-3">
                    <label for="tarea_id" class="form-label">Seleccionar Tarea</label>
                    <select class="form-select" id="tarea_id" name="tarea_id" required>
                        <option value="">Seleccione una tarea</option>
                        <?php while ($fila_tarea = $resultado_tareas->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $fila_tarea['id']; ?>">
                                <?php echo $fila_tarea['nombre']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Selección de los equipos (Checkboxes) -->
                <div class="mb-3">
                    <label class="form-label">Seleccionar Equipos</label>
                    <div>
                        <?php while ($fila_equipo = $resultado_equipos->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="equipo_id[]" value="<?php echo $fila_equipo['id']; ?>" id="equipo_<?php echo $fila_equipo['id']; ?>">
                                <label class="form-check-label" for="equipo_<?php echo $fila_equipo['id']; ?>">
                                    <?php echo $fila_equipo['marca'] . " - " . $fila_equipo['procesador'] . " (Unidades: " . $fila_equipo['unidades_disponibles'] . ")"; ?>
                                </label>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Asignar</button>
            </form>
        </div>
    </div>
    <script src="bootstrap.bundle.min.js"></script>
</body>

</html>
