<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Variable para mostrar mensajes
$mensaje = "";

// Obtener la lista de empleados para asignarles una laptop
try {
    $sqlEmpleados = "SELECT id, nombre FROM empleados WHERE id NOT IN (SELECT empleado_id FROM laptop)";
    $stmtEmpleados = $conexion->prepare($sqlEmpleados);
    $stmtEmpleados->execute();
    $empleados = $stmtEmpleados->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigoLaptop = $_POST['codigoLaptop'];
    $marca = $_POST['marca'];
    $procesador = $_POST['procesador'];
    $empleado_id = $_POST['empleado_id'];

    if (!empty($codigoLaptop) && !empty($marca) && !empty($procesador) && !empty($empleado_id)) {
        try {
            // Insertar la nueva laptop en la base de datos
            $sql = "INSERT INTO laptop (codigoLaptop, marca, procesador, empleado_id) 
                    VALUES (:codigoLaptop, :marca, :procesador, :empleado_id)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':codigoLaptop', $codigoLaptop);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':procesador', $procesador);
            $stmt->bindParam(':empleado_id', $empleado_id);

            if ($stmt->execute()) {
                $mensaje = "Laptop registrada con éxito.";
            } else {
                $mensaje = "Error al registrar la laptop.";
            }
        } catch (PDOException $e) {
            $mensaje = "Error: " . $e->getMessage();
        }
    } else {
        $mensaje = "Por favor, complete todos los campos obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Laptop</title>
    <!-- Bootstrap local -->
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
            <h2 class="mb-0">Registrar Laptop</h2>
            <a href="listar_equipos.php" class="btn btn-primary">Volver al Listado</a>
        </div>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form action="registrar_laptop.php" method="post">
            <div class="mb-3">
                <label for="codigoLaptop" class="form-label">Código de Laptop</label>
                <input type="number" class="form-control" id="codigoLaptop" name="codigoLaptop" required>
            </div>

            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <select class="form-control" id="marca" name="marca" required>
                    <option value="">Seleccione una marca</option>
                    <option value="DELL">DELL</option>
                    <option value="LENOVO">LENOVO</option>
                    <option value="MAC">MAC</option>
                    <option value="HP">HP</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="procesador" class="form-label">Procesador</label>
                <input type="text" class="form-control" id="procesador" name="procesador" required>
            </div>

            <div class="mb-3">
                <label for="empleado_id" class="form-label">Empleado Asignado</label>
                <select class="form-control" id="empleado_id" name="empleado_id" required>
                    <option value="">Seleccione un empleado</option>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado['id']; ?>"><?php echo $empleado['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Laptop</button>
        </form>
    </div>
    <!-- Contenido central fin -->

    <!-- Bootstrap JS local -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
