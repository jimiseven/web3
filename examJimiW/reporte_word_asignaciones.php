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

// Configurar encabezados para descargar como archivo .doc
header("Content-Type: application/vnd.ms-word");
header("Content-Disposition: attachment;filename=reporte_asignaciones.doc");
header("Cache-Control: max-age=0");

// Crear contenido en formato de tabla
echo "<html><body>";
echo "<h2>Reporte de Asignaciones</h2>";
echo "<table border='1'>";
echo "<tr><th>Nombre de la Tarea</th><th>Equipos Asignados</th></tr>";

foreach ($asignaciones as $asignacion) {
    echo "<tr>";
    echo "<td>{$asignacion['tarea_nombre']}</td>";
    echo "<td>{$asignacion['equipos_asignados']}</td>";
    echo "</tr>";
}

echo "</table>";
echo "</body></html>";
?>
