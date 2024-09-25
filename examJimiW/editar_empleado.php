<?php
include 'php/conexion.php';

// Obtener el empleado por su ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "SELECT * FROM empleados WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $puesto = $_POST['puesto'];
    $email = $_POST['email'];

    // Verificar si se subió una nueva foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    } else {
        $foto = $empleado['foto'];  // Mantener la foto anterior si no se subió una nueva
    }

    try {
        // Actualizar los datos del empleado
        $sql = "UPDATE empleados SET nombre = :nombre, puesto = :puesto, email = :email, foto = :foto WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':puesto', $puesto);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            header('Location: listar_empleados.php');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <!-- Bootstrap local -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Editar Empleado</h2>

        <form action="editar_empleado.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($empleado['nombre']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto</label>
                <input type="text" class="form-control" id="puesto" name="puesto" value="<?php echo htmlspecialchars($empleado['puesto']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($empleado['email']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto del Empleado</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <!-- Bootstrap JS local -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
