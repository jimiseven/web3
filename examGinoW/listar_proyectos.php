<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Consultar todos los proyectos
try {
    $sql = "SELECT * FROM proyectos";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Proyectos</title>
    <!-- Bootstrap local -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Listado de Proyectos</h2>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectos as $proyecto): ?>
                    <tr>
                        <td>
                            <?php if (!empty($proyecto['imagen'])): ?>
                                <!-- Mostrar la imagen en miniatura -->
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($proyecto['imagen']); ?>" class="img-thumbnail" style="width: 100px; height: 100px;">
                            <?php else: ?>
                                <img src="default-placeholder.png" class="img-thumbnail" style="width: 100px; height: 100px;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($proyecto['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($proyecto['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($proyecto['fecha_inicio']); ?></td>
                        <td><?php echo htmlspecialchars($proyecto['fecha_fin']); ?></td>
                        <td><?php echo htmlspecialchars($proyecto['estado']); ?></td>
                        <td>
                            <!-- Enlace para modificar -->
                            <a href="editar_proyecto.php?id=<?php echo $proyecto['id']; ?>" class="btn btn-warning btn-sm">Modificar</a>
                            <!-- Enlace para eliminar -->
                            <a href="eliminar_proyecto.php?id=<?php echo $proyecto['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este proyecto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS local -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
