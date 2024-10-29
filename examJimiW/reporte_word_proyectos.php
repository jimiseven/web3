<?php
include 'php/conexion.php';

// Obtener datos
$sql = "SELECT nombre, descripcion, fecha_inicio, fecha_fin, estado FROM proyectos";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Configurar encabezados para descargar como archivo .doc
header("Content-Type: application/vnd.ms-word");
header("Content-Disposition: attachment;filename=reporte_proyectos.doc");
header("Cache-Control: max-age=0");

// Crear contenido en formato de tabla
echo "<html><body>";
echo "<h2>Reporte de Proyectos</h2>";
echo "<table border='1'>";
echo "<tr><th>Nombre</th><th>Descripción</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Estado</th></tr>";

foreach ($proyectos as $proyecto) {
    echo "<tr>";
    echo "<td>{$proyecto['nombre']}</td>";
    echo "<td>{$proyecto['descripcion']}</td>";
    echo "<td>{$proyecto['fecha_inicio']}</td>";
    echo "<td>{$proyecto['fecha_fin']}</td>";
    echo "<td>{$proyecto['estado']}</td>";
    echo "</tr>";
}

echo "</table>";
echo "</body></html>";
?>
