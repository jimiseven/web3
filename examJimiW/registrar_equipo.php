<?php
include 'php/conexion.php'; // Incluir la conexión a la base de datos

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $procesador = $_POST['procesador'];
    $marca = $_POST['marca'];
    $unidades_disponibles = $_POST['unidades_disponibles'];

    // Consulta SQL usando prepared statements para evitar inyección SQL
    $sql = "INSERT INTO equipos (procesador, marca, unidades_disponibles) VALUES (?, ?, ?)";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        // Vincular parámetros y ejecutar la consulta
        $stmt->bindParam(1, $procesador);
        $stmt->bindParam(2, $marca);
        $stmt->bindParam(3, $unidades_disponibles);

        if ($stmt->execute()) {
            $mensaje = "Nuevo equipo registrado exitosamente.";
        } else {
            $mensaje = "Error al registrar equipo.";
        }
    } else {
        $mensaje = "Error al preparar la consulta: " . $conexion->errorInfo()[2];
    }
}
$conexion = null; // Cerrar conexión
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Equipo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css" /><!-- Asegúrate de tener el archivo Bootstrap local -->
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="index.html" class="text-light text-center">AdmiPro</a>
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
            <h2 class="mb-0">Registro de Equipos</h2>
            <a href="listar_equipos.php" class="btn btn-primary">Listado de Equipos</a>
        </div>
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form method="post" action="registrar_equipo.php">
            <div class="mb-3">
                <label for="procesador" class="form-label">Procesador</label>
                <input type="text" class="form-control" id="procesador" name="procesador" required>
            </div>

            <!-- Opción de marca utilizando Radio Buttons -->
            <div class="mb-3">
                <label class="form-label">Marca</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="marca" id="marcaIntel" value="Intel" required>
                        <label class="form-check-label" for="marcaIntel">Intel</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="marca" id="marcaAMD" value="AMD" required>
                        <label class="form-check-label" for="marcaAMD">AMD</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="marca" id="marcaNVIDIA" value="NVIDIA" required>
                        <label class="form-check-label" for="marcaNVIDIA">NVIDIA</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="marca" id="marcaApple" value="Apple" required>
                        <label class="form-check-label" for="marcaApple">Apple</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="unidades_disponibles" class="form-label">Unidades Disponibles</label>
                <input type="number" class="form-control" id="unidades_disponibles" name="unidades_disponibles" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    <!-- Contenido central fin-->
    <script src="bootstrap.bundle.min.js"></script> <!-- Asegúrate de tener el archivo Bootstrap local -->
</body>

</html>