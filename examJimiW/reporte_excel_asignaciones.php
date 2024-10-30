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

// Configurar encabezados para la descarga como archivo Excel .xls
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte_asignaciones.xls");
header("Cache-Control: max-age=0");

// Crear el contenido de la tabla en HTML con formato
echo "<table border='1' style='border-collapse: collapse; width: 100%; font-family: Arial, sans-serif;'>";

// Título del reporte
echo "<tr><td colspan='4' style='font-size: 18px; font-weight: bold; text-align: center; background-color: #4CAF50; color: white;'>Listado de Asignaciones</td></tr>";

// Encabezado de la tabla
echo "<tr style='background-color: #f2f2f2; font-weight: bold; text-align: left;'>";
echo "<th style='padding: 8px; border: 1px solid #ddd;'>Tarea</th>";
echo "<th style='padding: 8px; border: 1px solid #ddd;'>Empleado Asignado</th>";
echo "<th style='padding: 8px; border: 1px solid #ddd;'>Fecha de Inicio</th>";
echo "<th style='padding: 8px; border: 1px solid #ddd;'>Fecha de Fin</th>";
echo "</tr>";

// Filas de datos
foreach ($asignaciones as $asignacion) {
    echo "<tr>";
    echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($asignacion['nombre_tarea']) . "</td>";
    echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($asignacion['nombre_empleado']) . "</td>";
    echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($asignacion['fecha_inicio']) . "</td>";
    echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($asignacion['fecha_fin']) . "</td>";
    echo "</tr>";
}

// Cerrar la tabla
echo "</table>";
exit;
?>
