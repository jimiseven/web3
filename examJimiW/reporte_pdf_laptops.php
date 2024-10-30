<?php
include 'php/conexion.php';

// Obtener datos de la tabla laptop y los empleados asignados
$sql = "SELECT laptop.codigoLaptop, laptop.marca, laptop.procesador, empleados.nombre AS empleado_nombre 
        FROM laptop 
        LEFT JOIN empleados ON laptop.empleado_id = empleados.id";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$laptops = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Laptops</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Listado de Laptops</h2>
    <button onclick="window.print()">Descargar PDF</button> <!-- Botón para descargar como PDF -->
    <table>
        <tr>
            <th>Código</th>
            <th>Marca</th>
            <th>Procesador</th>
            <th>Empleado Asignado</th>
        </tr>
        <?php foreach ($laptops as $laptop): ?>
            <tr>
                <td><?php echo htmlspecialchars($laptop['codigoLaptop']); ?></td>
                <td><?php echo htmlspecialchars($laptop['marca']); ?></td>
                <td><?php echo htmlspecialchars($laptop['procesador']); ?></td>
                <td><?php echo htmlspecialchars($laptop['empleado_nombre'] ?? 'No asignado'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
