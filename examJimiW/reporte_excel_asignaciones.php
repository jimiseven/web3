<?php
include 'php/conexion.php';

// Obtener datos
$sql = "
    SELECT t.nombre AS tarea_nombre, 
           GROUP_CONCAT(e.marca, ' - ', e.procesador SEPARATOR ', ') AS equipos_asignados
    FROM tarea_equipo te
    INNER JOIN tareas t ON te.tarea_id = t.id
    INNER JOIN equipos e ON te.equipo_id = e.id
    GROUP BY t.id
";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$asignaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Configurar los encabezados para descargar como Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=reporte_asignaciones.xls");
header("Cache-Control: max-age=0");

// Crear el contenido de la tabla en HTML
echo "<table border='1'>";
echo "<tr><th>Nombre de la Tarea</th><th>Equipos Asignados</th></tr>";

foreach ($asignaciones as $asignacion) {
    echo "<tr>";
    echo "<td>{$asignacion['tarea_nombre']}</td>";
    echo "<td>{$asignacion['equipos_asignados']}</td>";
    echo "</tr>";
}

echo "</table>";
?>
