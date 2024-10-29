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

// Configurar encabezados para descargar como archivo .doc
header("Content-Type: application/vnd.ms-word");
header("Content-Disposition: attachment;filename=reporte_tareas.doc");
header("Cache-Control: max-age=0");

// Crear contenido en formato de tabla
echo "<html><body>";
echo "<h2>Reporte de Tareas</h2>";
echo "<table border='1'>";
echo "<tr><th>Nombre</th><th>Descripción</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Estado</th><th>Proyecto</th><th>Empleado Responsable</th></tr>";

foreach ($tareas as $tarea) {
    echo "<tr>";
    echo "<td>{$tarea['nombre']}</td>";
    echo "<td>{$tarea['descripcion']}</td>";
    echo "<td>{$tarea['fecha_inicio']}</td>";
    echo "<td>{$tarea['fecha_fin']}</td>";
    echo "<td>{$tarea['estado']}</td>";
    echo "<td>{$tarea['nombre_proyecto']}</td>";
    echo "<td>{$tarea['nombre_empleado']}</td>";
    echo "</tr>";
}

echo "</table>";
echo "</body></html>";
?>
