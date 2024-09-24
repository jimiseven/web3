<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Consultar todas las tareas
try {
    $sql = "SELECT tareas.*, proyectos.nombre AS nombre_proyecto, empleados.nombre AS nombre_empleado 
            FROM tareas
            JOIN proyectos ON tareas.proyecto_id = proyectos.id
            JOIN empleados ON tareas.empleado_id = empleados.id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tareas</title>
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
            <h2 class="mb-0">Listado de Tareas</h2>
            <a href="registro_empleados.php" class="btn btn-primary">Añadir Tarea</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                    <th>Proyecto</th>
                    <th>Empleado Responsable</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $tarea): ?>
                    <tr>
                        <td>
                            <?php if (!empty($tarea['imagen'])): ?>
                                <!-- Mostrar la imagen en miniatura -->
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($tarea['imagen']); ?>" class="img-thumbnail" style="width: 100px; height: 100px;">
                            <?php else: ?>
                                <img src="default-placeholder.png" class="img-thumbnail" style="width: 100px; height: 100px;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($tarea['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($tarea['fecha_inicio']); ?></td>
                        <td><?php echo htmlspecialchars($tarea['fecha_fin']); ?></td>
                        <td><?php echo htmlspecialchars($tarea['estado']); ?></td>
                        <td><?php echo htmlspecialchars($tarea['nombre_proyecto']); ?></td>
                        <td><?php echo htmlspecialchars($tarea['nombre_empleado']); ?></td>
                        <td>
                            <!-- Enlace para modificar -->
                            <a href="editar_tarea.php?id=<?php echo $tarea['id']; ?>" class="btn btn-warning btn-sm">Modificar</a>
                            <!-- Enlace para eliminar -->
                            <a href="eliminar_tarea.php?id=<?php echo $tarea['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Contenido central fin -->
    <!-- Bootstrap JS local -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>