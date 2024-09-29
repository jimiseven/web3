<?php
include 'php/conexion.php'; // Incluir la conexión a la base de datos

// Consulta SQL para obtener las asignaciones de tareas y equipos
$sql = "
    SELECT t.nombre AS tarea_nombre, e.marca, e.procesador, te.tarea_id, te.equipo_id
    FROM tarea_equipo te
    INNER JOIN tareas t ON te.tarea_id = t.id
    INNER JOIN equipos e ON te.equipo_id = e.id
";
$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Asignaciones</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css" /> <!-- Asegúrate de tener el archivo Bootstrap local -->
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
            <h2 class="mb-0">Listado de Asiganciones</h2>
            <a href="asignar_equipo.php" class="btn btn-primary">Añadir Asignacion</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Tarea</th>
                    <th>Nombre de la Tarea</th>
                    <th>ID Equipo</th>
                    <th>Marca del Equipo</th>
                    <th>Procesador del Equipo</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado->rowCount() > 0): ?>
                    <?php while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo $fila['tarea_id']; ?></td>
                            <td><?php echo $fila['tarea_nombre']; ?></td>
                            <td><?php echo $fila['equipo_id']; ?></td>
                            <td><?php echo $fila['marca']; ?></td>
                            <td><?php echo $fila['procesador']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No hay asignaciones registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Contenido central fin-->
    <script src="js/bootstrap.bundle.min.js"></script> <!-- Asegúrate de tener el archivo Bootstrap local -->
</body>

</html>

<?php
// $conexion = null; // Cerrar la conexión
?>