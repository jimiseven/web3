<?php
include 'php/conexion.php';

// Obtener datos
$sql = "SELECT id, procesador, marca, unidades_disponibles FROM equipos";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Equipos - PDF</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body onload="window.print()">
    <h2>Reporte de Equipos</h2>
    <table>
        <tr><th>ID</th><th>Procesador</th><th>Marca</th><th>Unidades Disponibles</th></tr>
        <?php foreach ($equipos as $equipo): ?>
            <tr>
                <td><?php echo htmlspecialchars($equipo['id']); ?></td>
                <td><?php echo htmlspecialchars($equipo['procesador']); ?></td>
                <td><?php echo htmlspecialchars($equipo['marca']); ?></td>
                <td><?php echo htmlspecialchars($equipo['unidades_disponibles']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
