<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Variable para mostrar mensajes
$mensaje = "";

// Obtener las tareas y empleados para los selects
try {
    // Consulta para tareas
    $sqlTareas = "SELECT id, nombre FROM tareas";
    $stmtTareas = $conexion->prepare($sqlTareas);
    $stmtTareas->execute();
    $tareas = $stmtTareas->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para empleados
    $sqlEmpleados = "SELECT id, nombre FROM empleados";
    $stmtEmpleados = $conexion->prepare($sqlEmpleados);
    $stmtEmpleados->execute();
    $empleados = $stmtEmpleados->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tarea_id = $_POST['tarea_id'];
    $empleado_ids = $_POST['empleado_ids']; // Esto es un array con los IDs de empleados seleccionados
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    if (!empty($tarea_id) && !empty($empleado_ids) && !empty($fecha_inicio) && !empty($fecha_fin)) {
        try {
            // Insertar cada empleado con la misma tarea y fechas
            $sql = "INSERT INTO empleados_tarea (tarea_id, empleado_id, fecha_inicio, fecha_fin) VALUES (:tarea_id, :empleado_id, :fecha_inicio, :fecha_fin)";
            $stmt = $conexion->prepare($sql);

            foreach ($empleado_ids as $empleado_id) {
                $stmt->execute([
                    ':tarea_id' => $tarea_id,
                    ':empleado_id' => $empleado_id,
                    ':fecha_inicio' => $fecha_inicio,
                    ':fecha_fin' => $fecha_fin
                ]);
            }

            $mensaje = "Asignación registrada con éxito.";
        } catch (PDOException $e) {
            $mensaje = "Error: " . $e->getMessage();
        }
    } else {
        $mensaje = "Por favor, complete todos los campos obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Asignación</title>
    <!-- Bootstrap local -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="index.html" class="text-light text-center">AdmiPro</a>
        <a href="listar_empleados.php">Empleados</a>
        <a href="listar_proyectos.php">Proyectos</a>
        <a href="listar_tareas.php">Tareas</a>
        <a href="listar_equipos.php">Equipos</a>
        <a href="listar_asignaciones.php">Asignaciones</a>
    </div>
    <!-- Sidebar fin-->

    <!-- Contenido central -->
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Registrar Asignación</h2>
            <a href="listar_asignaciones.php" class="btn btn-primary">Volver al Listado</a>
        </div>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form action="registro_asignacion.php" method="post">
            <div class="mb-3">
                <label for="tarea_id" class="form-label">Tarea</label>
                <select class="form-control" id="tarea_id" name="tarea_id" required>
                    <option value="">Seleccione una tarea</option>
                    <?php foreach ($tareas as $tarea): ?>
                        <option value="<?php echo $tarea['id']; ?>"><?php echo $tarea['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="empleado_ids" class="form-label">Empleados Asignados</label>
                <select class="form-control" id="empleado_ids" name="empleado_ids[]" multiple required>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado['id']; ?>"><?php echo $empleado['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
                <small class="form-text text-muted">Mantenga presionada la tecla Ctrl (Windows) o Command (Mac) para seleccionar varios empleados.</small>
            </div>

            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>

            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Asignación</button>
        </form>
    </div>
    <!-- Contenido central fin -->

    <!-- Bootstrap JS local -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
