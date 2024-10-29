<?php
include 'php/conexion.php';

// Obtener datos
$sql = "
    SELECT t.nombre AS tarea_nombre, 
           GROUP_CONCAT(e.marca, ' - ', e.procesador SEPARATOR ', ') AS equipos_asignados
    FROM tarea_equipo te
    INNER JOIN tareas t ON te.tarea_id = t.id
    INNER JOIN equipos e ON te.equipo_id = e.id
    GROUP BY t.id
";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$asignaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asignaciones - PDF</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body onload="window.print()">
    <h2>Reporte de Asignaciones</h2>
    <table>
        <tr><th>Nombre de la Tarea</th><th>Equipos Asignados</th></tr>
        <?php foreach ($asignaciones as $asignacion): ?>
            <tr>
                <td><?php echo htmlspecialchars($asignacion['tarea_nombre']); ?></td>
                <td><?php echo htmlspecialchars($asignacion['equipos_asignados']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
