<?php
include 'php/conexion.php';

// Obtener datos
$sql = "SELECT id, procesador, marca, unidades_disponibles FROM equipos";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Configurar los encabezados para descargar como Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=reporte_equipos.xls");
header("Cache-Control: max-age=0");

// Crear el contenido de la tabla en HTML
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
?>
