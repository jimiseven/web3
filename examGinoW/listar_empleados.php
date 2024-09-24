<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Consultar todos los empleados
try {
    $sql = "SELECT * FROM empleados";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Empleados</title>
    <!-- Bootstrap local -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css" />

</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-light text-center">AdmiPro</h4>
        <a href="registro_empleados.php">Empleados</a>
        <a href="registro_proyectos.php">Proyectos</a>
        <a href="registro_tareas.php">Tareas</a>
    </div>
    <!-- Sidebar fin-->

    <!-- Contenido central -->
    <div class="content">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Listado de Empleados</h2>
                <a href="registro_empleados.php" class="btn btn-primary">Añadir Empleado</a>
            </div>

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empleados as $empleado): ?>
                        <tr>
                            <td>
                                <?php if (!empty($empleado['foto'])): ?>
                                    <!-- Mostrar la imagen en miniatura -->
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($empleado['foto']); ?>" class="img-thumbnail" style="width: 100px; height: 100px;">
                                <?php else: ?>
                                    <img src="default-placeholder.png" class="img-thumbnail" style="width: 100px; height: 100px;">
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($empleado['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($empleado['puesto']); ?></td>
                            <td><?php echo htmlspecialchars($empleado['email']); ?></td>
                            <td>
                                <!-- Enlace para modificar -->
                                <a href="editar_empleado.php?id=<?php echo $empleado['id']; ?>" class="btn btn-warning btn-sm">Modificar</a>
                                <!-- Enlace para eliminar -->
                                <a href="eliminar_empleado.php?id=<?php echo $empleado['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Contenido central fin -->


    <!-- Bootstrap JS local -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>