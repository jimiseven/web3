<?php
include 'php/conexion.php';

// Obtener datos de la tabla laptop y los empleados asignados
$sql = "SELECT laptop.codigoLaptop, laptop.marca, laptop.procesador, empleados.nombre AS empleado_nombre 
        FROM laptop 
        LEFT JOIN empleados ON laptop.empleado_id = empleados.id";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$laptops = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Configurar los encabezados para descargar como Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=reporte_laptops.xls");
header("Cache-Control: max-age=0");

// Crear el contenido de la tabla en HTML para exportar a Excel
echo "<table border='1'>";
echo "<tr><th>Código</th><th>Marca</th><th>Procesador</th><th>Empleado Asignado</th></tr>";

foreach ($laptops as $laptop) {
    $empleado_nombre = $laptop['empleado_nombre'] ?? 'No asignado';
    echo "<tr>";
    echo "<td>{$laptop['codigoLaptop']}</td>";
    echo "<td>{$laptop['marca']}</td>";
    echo "<td>{$laptop['procesador']}</td>";
    echo "<td>{$empleado_nombre}</td>";
    echo "</tr>";
}

echo "</table>";
?>
