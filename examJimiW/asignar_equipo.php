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
    $equipo_id = $_POST['equipo_id'];

    // Empezar una transacción para garantizar la consistencia de los datos
    $conexion->beginTransaction();

    try {
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

            if ($stmt_actualizar->execute()) {
                // Si todo va bien, confirmar la transacción
                $conexion->commit();
                $mensaje = "Equipo asignado a la tarea exitosamente y se actualizó el número de unidades.";
            } else {
                // Si la actualización falla, lanzar una excepción
                throw new Exception("Error al actualizar las unidades del equipo.");
            }
        } else {
            throw new Exception("Error al asignar el equipo a la tarea.");
        }
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
    <title>Asignar Equipo a Tarea</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css" /> <!-- Asegúrate de tener el archivo Bootstrap local -->
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="index.html" class="text-light text-center">AdmiPro</a>
            <a href="listar_empleados.php">Empleados</a>
            <a href="listar_proyectos.php">Proyectos</a>
            <a href="listar_tareas.php">Tareas</a>
            <a href="listar_equipos.php">Equipos</a>
        </div>
        <!-- Sidebar fin-->

        <!-- Contenido central -->
        <div class="content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Asignar Equipo a Tarea</h2>
                <a href="listar_asignaciones.php" class="btn btn-primary">Listado de Asiganciones</a>
            </div>
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

                <!-- Selección del equipo -->
                <div class="mb-3">
                    <label for="equipo_id" class="form-label">Seleccionar Equipo</label>
                    <select class="form-select" id="equipo_id" name="equipo_id" required>
                        <option value="">Seleccione un equipo</option>
                        <?php while ($fila_equipo = $resultado_equipos->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $fila_equipo['id']; ?>">
                                <?php echo $fila_equipo['marca'] . " - " . $fila_equipo['procesador'] . " (Unidades: " . $fila_equipo['unidades_disponibles'] . ")"; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Asignar</button>
            </form>
        </div>

    </div>
    <script src="bootstrap.bundle.min.js"></script> <!-- Asegúrate de tener el archivo Bootstrap local -->
</body>

</html>

<?php
$conexion = null; // Cerrar la conexión
?>