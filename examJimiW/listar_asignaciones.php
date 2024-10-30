<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Consultar todas las tareas con sus empleados asignados
try {
    $sql = "SELECT tareas.id AS tarea_id, tareas.nombre AS nombre_tarea, empleados.nombre AS nombre_empleado, 
                   empleados_tarea.fecha_inicio, empleados_tarea.fecha_fin
            FROM empleados_tarea
            JOIN empleados ON empleados_tarea.empleado_id = empleados.id
            JOIN tareas ON empleados_tarea.tarea_id = tareas.id
            ORDER BY tareas.id, empleados_tarea.fecha_inicio";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $asignaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Agrupar asignaciones por tarea
$tareas = [];
foreach ($asignaciones as $asignacion) {
    $tarea_id = $asignacion['tarea_id'];
    if (!isset($tareas[$tarea_id])) {
        $tareas[$tarea_id] = [
            'nombre_tarea' => $asignacion['nombre_tarea'],
            'empleados' => []
        ];
    }
    $tareas[$tarea_id]['empleados'][] = [
        'nombre_empleado' => $asignacion['nombre_empleado'],
        'fecha_inicio' => $asignacion['fecha_inicio'],
        'fecha_fin' => $asignacion['fecha_fin']
    ];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Asignaciones</title>
    <!-- Bootstrap local -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        h2 {
            font-weight: 600;
            color: #333;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #4CAF50 !important;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        .table tbody tr td {
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
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
    <div class="content mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Listado de Asignaciones</h2>
            <div class="btn-group">
                <a href="registro_asignacion.php" class="btn btn-primary">Añadir Asignación</a>
                <a href="reporte_excel_asignaciones.php" class="btn btn-secondary">Excel</a>
                <a href="reporte_pdf_asignaciones.php" class="btn btn-secondary">PDF</a>
                <a href="reporte_word_asignaciones.php" class="btn btn-secondary">Word</a>
            </div>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Tarea</th>
                    <th>Empleados Asignados</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $tarea): ?>
                    <tr>
                        <td rowspan="<?php echo count($tarea['empleados']); ?>" class="align-middle text-center">
                            <strong><?php echo htmlspecialchars($tarea['nombre_tarea']); ?></strong>
                        </td>
                        <?php foreach ($tarea['empleados'] as $index => $empleado): ?>
                            <?php if ($index > 0) echo '<tr>'; ?>
                            <td><?php echo htmlspecialchars($empleado['nombre_empleado']); ?></td>
                            <td><?php echo htmlspecialchars($empleado['fecha_inicio']); ?></td>
                            <td><?php echo htmlspecialchars($empleado['fecha_fin']); ?></td>
                            <?php if ($index > 0) echo '</tr>'; ?>
                        <?php endforeach; ?>
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
