<?php
include 'php/conexion.php';

// Obtener la tarea por su ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Obtener la información de la tarea
        $sql = "SELECT * FROM tareas WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $tarea = $stmt->fetch(PDO::FETCH_ASSOC);

        // Obtener todos los proyectos para el select
        $sqlProyectos = "SELECT id, nombre FROM proyectos";
        $stmtProyectos = $conexion->prepare($sqlProyectos);
        $stmtProyectos->execute();
        $proyectos = $stmtProyectos->fetchAll(PDO::FETCH_ASSOC);

        // Obtener todos los empleados para el select
        $sqlEmpleados = "SELECT id, nombre FROM empleados";
        $stmtEmpleados = $conexion->prepare($sqlEmpleados);
        $stmtEmpleados->execute();
        $empleados = $stmtEmpleados->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $estado = $_POST['estado'];
    $proyecto_id = $_POST['proyecto_id'];
    $empleado_id = $_POST['empleado_id'];

    // Verificar si se subió una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    } else {
        $imagen = $tarea['imagen'];  // Mantener la imagen anterior si no se subió una nueva
    }

    try {
        // Actualizar los datos de la tarea
        $sql = "UPDATE tareas SET nombre = :nombre, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, estado = :estado, proyecto_id = :proyecto_id, empleado_id = :empleado_id, imagen = :imagen WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':proyecto_id', $proyecto_id);
        $stmt->bindParam(':empleado_id', $empleado_id);
        $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            header('Location: listar_tareas.php');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <!-- Bootstrap local -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Editar Tarea</h2>

        <form action="editar_tarea.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Tarea</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($tarea['nombre']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($tarea['descripcion']); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo htmlspecialchars($tarea['fecha_inicio']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo htmlspecialchars($tarea['fecha_fin']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <div>
                    <input type="radio" id="pendiente" name="estado" value="Pendiente" <?php if ($tarea['estado'] == 'Pendiente') echo 'checked'; ?> required>
                    <label for="pendiente">Pendiente</label>
                </div>
                <div>
                    <input type="radio" id="en_progreso" name="estado" value="En progreso" <?php if ($tarea['estado'] == 'En progreso') echo 'checked'; ?> required>
                    <label for="en_progreso">En progreso</label>
                </div>
                <div>
                    <input type="radio" id="completada" name="estado" value="Completada" <?php if ($tarea['estado'] == 'Completada') echo 'checked'; ?> required>
                    <label for="completada">Completada</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="proyecto_id" class="form-label">Proyecto Asociado</label>
                <select class="form-control" id="proyecto_id" name="proyecto_id" required>
                    <?php foreach ($proyectos as $proyecto): ?>
                        <option value="<?php echo $proyecto['id']; ?>" <?php if ($proyecto['id'] == $tarea['proyecto_id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($proyecto['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="empleado_id" class="form-label">Empleado Responsable</label>
                <select class="form-control" id="empleado_id" name="empleado_id" required>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado['id']; ?>" <?php if ($empleado['id'] == $tarea['empleado_id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($empleado['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen de la Tarea</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <!-- Bootstrap JS local -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
