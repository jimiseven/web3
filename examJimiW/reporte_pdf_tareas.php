<?php
include 'php/conexion.php';

// Obtener datos
$sql = "SELECT tareas.nombre, tareas.descripcion, tareas.fecha_inicio, tareas.fecha_fin, tareas.estado, 
        proyectos.nombre AS nombre_proyecto, empleados.nombre AS nombre_empleado 
        FROM tareas 
        JOIN proyectos ON tareas.proyecto_id = proyectos.id 
        JOIN empleados ON tareas.empleado_id = empleados.id";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Tareas - PDF</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body onload="window.print()">
    <h2>Reporte de Tareas</h2>
    <table>
        <tr><th>Nombre</th><th>Descripción</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Estado</th><th>Proyecto</th><th>Empleado Responsable</th></tr>
        <?php foreach ($tareas as $tarea): ?>
            <tr>
                <td><?php echo htmlspecialchars($tarea['nombre']); ?></td>
                <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($tarea['fecha_inicio']); ?></td>
                <td><?php echo htmlspecialchars($tarea['fecha_fin']); ?></td>
                <td><?php echo htmlspecialchars($tarea['estado']); ?></td>
                <td><?php echo htmlspecialchars($tarea['nombre_proyecto']); ?></td>
                <td><?php echo htmlspecialchars($tarea['nombre_empleado']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
