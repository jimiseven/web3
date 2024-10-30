<?php
include 'php/conexion.php';

// Obtener datos de las asignaciones
$sql = "SELECT tareas.nombre AS nombre_tarea, empleados.nombre AS nombre_empleado, 
               empleados_tarea.fecha_inicio, empleados_tarea.fecha_fin
        FROM empleados_tarea
        JOIN empleados ON empleados_tarea.empleado_id = empleados.id
        JOIN tareas ON empleados_tarea.tarea_id = tareas.id
        ORDER BY tareas.id, empleados_tarea.fecha_inicio";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$asignaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asignaciones</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Listado de Asignaciones</h2>
    <button onclick="window.print()">Descargar PDF</button>
    <table>
        <tr>
            <th>Tarea</th>
            <th>Empleado Asignado</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
        </tr>
        <?php foreach ($asignaciones as $asignacion): ?>
            <tr>
                <td><?php echo htmlspecialchars($asignacion['nombre_tarea']); ?></td>
                <td><?php echo htmlspecialchars($asignacion['nombre_empleado']); ?></td>
                <td><?php echo htmlspecialchars($asignacion['fecha_inicio']); ?></td>
                <td><?php echo htmlspecialchars($asignacion['fecha_fin']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
