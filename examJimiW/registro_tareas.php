<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Variable para mostrar mensajes
$mensaje = "";

// Obtener los proyectos y empleados para los selects
try {
    // Consulta para proyectos
    $sqlProyectos = "SELECT id, nombre FROM proyectos";
    $stmtProyectos = $conexion->prepare($sqlProyectos);
    $stmtProyectos->execute();
    $proyectos = $stmtProyectos->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para empleados
    $sqlEmpleados = "SELECT id, nombre FROM empleados";
    $stmtEmpleados = $conexion->prepare($sqlEmpleados);
    $stmtEmpleados->execute();
    $empleados = $stmtEmpleados->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
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

    // Verificar si se subió una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    } else {
        $imagen = null;
    }

    // Verificar que los campos obligatorios no estén vacíos
    if (!empty($nombre) && !empty($descripcion) && !empty($fecha_inicio) && !empty($fecha_fin) && !empty($estado) && !empty($proyecto_id) && !empty($empleado_id)) {
        // Insertar en la base de datos
        try {
            $sql = "INSERT INTO tareas (nombre, descripcion, fecha_inicio, fecha_fin, estado, proyecto_id, empleado_id, imagen) 
                    VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_fin, :estado, :proyecto_id, :empleado_id, :imagen)";
            $stmt = $conexion->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':proyecto_id', $proyecto_id);
            $stmt->bindParam(':empleado_id', $empleado_id);
            $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);  // Long Blob para la imagen

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $mensaje = "Tarea registrada con éxito.";
            } else {
                $mensaje = "Error al registrar la tarea.";
            }
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
    <title>Registrar Tarea</title>
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
    </div>
    <!-- Sidebar fin-->

    <!-- Contenido central -->
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Registrar de Tareas</h2>
            <a href="listar_tareas.php" class="btn btn-primary">Listado</a>
        </div>


        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form action="registro_tareas.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Tarea</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>

            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <div>
                    <input type="radio" id="pendiente" name="estado" value="Pendiente" required>
                    <label for="pendiente">Pendiente</label>
                </div>
                <div>
                    <input type="radio" id="en_progreso" name="estado" value="En progreso" required>
                    <label for="en_progreso">En progreso</label>
                </div>
                <div>
                    <input type="radio" id="completada" name="estado" value="Completada" required>
                    <label for="completada">Completada</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="proyecto_id" class="form-label">Proyecto Asociado</label>
                <select class="form-control" id="proyecto_id" name="proyecto_id" required>
                    <option value="">Seleccione un proyecto</option>
                    <?php foreach ($proyectos as $proyecto): ?>
                        <option value="<?php echo $proyecto['id']; ?>"><?php echo $proyecto['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="empleado_id" class="form-label">Empleado Responsable</label>
                <select class="form-control" id="empleado_id" name="empleado_id" required>
                    <option value="">Seleccione un empleado</option>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado['id']; ?>"><?php echo $empleado['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen de la Tarea</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Registrar Tarea</button>
        </form>
    </div>
    <!-- Contenido central fin -->
    <div class="container mt-5">

    </div>

    <!-- Bootstrap JS local -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>