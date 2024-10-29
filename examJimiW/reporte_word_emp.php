<?php
include 'php/conexion.php';

// Obtener datos
$sql = "SELECT nombre, puesto, email FROM empleados";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Configurar encabezados para descargar como archivo .doc
header("Content-Type: application/vnd.ms-word");
header("Content-Disposition: attachment;filename=reporte_empleados.doc");
header("Cache-Control: max-age=0");

// Crear contenido en formato de tabla
echo "<html><body>";
echo "<h2>Reporte de Empleados</h2>";
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
echo "</body></html>";
?>
