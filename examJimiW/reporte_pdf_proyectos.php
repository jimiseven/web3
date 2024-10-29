<?php
include 'php/conexion.php';

// Obtener datos
$sql = "SELECT nombre, descripcion, fecha_inicio, fecha_fin, estado FROM proyectos";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Proyectos - PDF</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body onload="window.print()">
    <h2>Reporte de Proyectos</h2>
    <table>
        <tr><th>Nombre</th><th>Descripción</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Estado</th></tr>
        <?php foreach ($proyectos as $proyecto): ?>
            <tr>
                <td><?php echo htmlspecialchars($proyecto['nombre']); ?></td>
                <td><?php echo htmlspecialchars($proyecto['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($proyecto['fecha_inicio']); ?></td>
                <td><?php echo htmlspecialchars($proyecto['fecha_fin']); ?></td>
                <td><?php echo htmlspecialchars($proyecto['estado']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
