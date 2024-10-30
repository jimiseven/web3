<?php
include 'php/conexion.php'; // Incluir la conexión a la base de datos

// Establecer encabezado para descargar como archivo .doc
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=laptops.doc");

echo '<h2>Listado de Laptops</h2>';
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><th>Código</th><th>Marca</th><th>Procesador</th><th>Empleado Asignado</th></tr>';

// Consulta para obtener los datos de laptops y empleados asignados
$sql = "SELECT laptop.codigoLaptop, laptop.marca, laptop.procesador, empleados.nombre AS empleado_nombre 
        FROM laptop 
        LEFT JOIN empleados ON laptop.empleado_id = empleados.id";
$resultado = $conexion->query($sql);

// Escribir los datos en la tabla
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $empleado_nombre = $fila['empleado_nombre'] ?? 'No asignado';
    echo '<tr>';
    echo '<td>' . htmlspecialchars($fila['codigoLaptop']) . '</td>';
    echo '<td>' . htmlspecialchars($fila['marca']) . '</td>';
    echo '<td>' . htmlspecialchars($fila['procesador']) . '</td>';
    echo '<td>' . htmlspecialchars($empleado_nombre) . '</td>';
    echo '</tr>';
}

echo '</table>';
exit;
?>
