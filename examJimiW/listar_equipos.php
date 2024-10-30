<?php
include 'php/conexion.php'; // Incluir la conexión a la base de datos

// Consulta para obtener todos los laptops
$sql = "SELECT * FROM laptop";
$resultado = $conexion->query($sql); // Ejecutar la consulta

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Laptops</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="index.html" class="text-light text-center">AdmiProd</a>
        <a href="listar_empleados.php">Empleados</a>
        <a href="listar_proyectos.php">Proyectos</a>
        <a href="listar_tareas.php">Tareas</a>
        <a href="listar_equipos.php">Equipos</a>
        <a href="listar_asignaciones.php">Asignaciones</a>
    </div>
    <!-- Sidebar fin-->

    <!-- Contenido central -->
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Listado de Laptops</h2>
            <a href="registrar_laptop.php" class="btn btn-primary">Asignar Laptop</a>
            <div class="btn-group">
                <a href="reporte_excel_laptops.php" class="btn btn-secondary">Excel</a>
                <a href="reporte_pdf_laptops.php" class="btn btn-secondary">PDF</a>
                <a href="reporte_word_laptops.php" class="btn btn-secondary">Word</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Marca</th>
                    <th>Procesador</th>
                    <th>Empleado Asignado</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado->rowCount() > 0): ?>
                    <?php while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo $fila['codigoLaptop']; ?></td>
                            <td><?php echo $fila['marca']; ?></td>
                            <td><?php echo $fila['procesador']; ?></td>
                            <td>
                                <?php
                                // Consulta para obtener el nombre del empleado asignado
                                $empleado_id = $fila['empleado_id'];
                                $empleado_sql = "SELECT nombre FROM empleados WHERE id = :empleado_id";
                                $empleado_stmt = $conexion->prepare($empleado_sql);
                                $empleado_stmt->bindParam(':empleado_id', $empleado_id, PDO::PARAM_INT);
                                $empleado_stmt->execute();
                                $empleado = $empleado_stmt->fetch(PDO::FETCH_ASSOC);
                                echo $empleado ? $empleado['nombre'] : "No asignado";
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay laptops registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Contenido central fin-->
    <script src="bootstrap.bundle.min.js"></script>
</body>

</html>
<!-- 
<?php
$conexion = null; // Cerrar conexión
?> -->
