<?php
include 'php/conexion.php';

// Obtener datos
$sql = "SELECT nombre, puesto, email FROM empleados";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Empleados - PDF</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body onload="window.print()">
    <h2>Reporte de Empleados</h2>
    <table>
        <tr><th>Nombre</th><th>Puesto</th><th>Email</th></tr>
        <?php foreach ($empleados as $empleado): ?>
            <tr>
                <td><?php echo htmlspecialchars($empleado['nombre']); ?></td>
                <td><?php echo htmlspecialchars($empleado['puesto']); ?></td>
                <td><?php echo htmlspecialchars($empleado['email']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
