<?php
include 'php/conexion.php';

// Obtener datos
$sql = "SELECT id, procesador, marca, unidades_disponibles FROM equipos";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Configurar encabezados para descargar como archivo .doc
header("Content-Type: application/vnd.ms-word");
header("Content-Disposition: attachment;filename=reporte_equipos.doc");
header("Cache-Control: max-age=0");

// Crear contenido en formato de tabla
echo "<html><body>";
echo "<h2>Reporte de Equipos</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Procesador</th><th>Marca</th><th>Unidades Disponibles</th></tr>";

foreach ($equipos as $equipo) {
    echo "<tr>";
    echo "<td>{$equipo['id']}</td>";
    echo "<td>{$equipo['procesador']}</td>";
    echo "<td>{$equipo['marca']}</td>";
    echo "<td>{$equipo['unidades_disponibles']}</td>";
    echo "</tr>";
}

echo "</table>";
echo "</body></html>";
?>
