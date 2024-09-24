<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Variable para mostrar mensajes
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $estado = $_POST['estado'];

    // Verificar si se subió una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        // Obtener la imagen como blob
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    } else {
        $imagen = null;
    }

    // Verificar que los campos no estén vacíos
    if (!empty($nombre) && !empty($descripcion) && !empty($fecha_inicio) && !empty($fecha_fin) && !empty($estado)) {
        // Insertar en la base de datos
        try {
            $sql = "INSERT INTO proyectos (nombre, descripcion, fecha_inicio, fecha_fin, estado, imagen) 
                    VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_fin, :estado, :imagen)";
            $stmt = $conexion->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);  // Long Blob para la imagen

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $mensaje = "Proyecto registrado con éxito.";
            } else {
                $mensaje = "Error al registrar el proyecto.";
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
    <title>Registrar Proyecto</title>
    <!-- Bootstrap local -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-light text-center">AdmiPro</h4>
        <a href="listar_empleados.php">Empleados</a>
        <a href="listar_proyectos.php">Proyectos</a>
        <a href="listar_tareas.php">Tareas</a>
    </div>
    <!-- Sidebar fin-->

    <!-- Contenido central -->
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Registro de Proyectos</h2>
            <a href="listar_proyectos.php" class="btn btn-primary">Listado de Proyectos</a>
        </div>


        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form action="registro_proyectos.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Proyecto</label>
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
                <select class="form-control" id="estado" name="estado" required>
                    <option value="Planeado">Planeado</option>
                    <option value="En progreso">En progreso</option>
                    <option value="Completado">Completado</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen del Proyecto</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Registrar Proyecto</button>
        </form>
    </div>
    <!-- Contenido central fin -->
    <!-- Bootstrap JS local -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>