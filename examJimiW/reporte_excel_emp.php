<?php
include 'php/conexion.php';

// Obtener datos
$sql = "SELECT nombre, puesto, email FROM empleados";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Configurar los encabezados para descargar como Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=reporte_empleados.xls");
header("Cache-Control: max-age=0");

// Crear el contenido de la tabla en HTML
echo "<table border='1'>";
echo "<tr><th>Nombre</th><th>Puesto</th><th>Email</th></tr>";

foreach ($empleados as $empleado) {
    echo "<tr>";
    echo "<td>{$empleado['nombre']}</td>";
    echo "<td>{$empleado['puesto']}</td>";
    echo "<td>{$empleado['email']}</td>";
    echo "</tr>";
}

echo "</table>";
?>
