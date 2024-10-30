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

// Configurar encabezados para la descarga como archivo Word
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=reporte_asignaciones.doc");

echo '<h2>Listado de Asignaciones</h2>';
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><th>Tarea</th><th>Empleado Asignado</th><th>Fecha de Inicio</th><th>Fecha de Fin</th></tr>';

foreach ($asignaciones as $asignacion) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($asignacion['nombre_tarea']) . '</td>';
    echo '<td>' . htmlspecialchars($asignacion['nombre_empleado']) . '</td>';
    echo '<td>' . htmlspecialchars($asignacion['fecha_inicio']) . '</td>';
    echo '<td>' . htmlspecialchars($asignacion['fecha_fin']) . '</td>';
    echo '</tr>';
}

echo '</table>';
?>
