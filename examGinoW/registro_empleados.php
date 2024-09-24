<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Variables para almacenar mensajes de éxito o error
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $puesto = $_POST['puesto'];
    $email = $_POST['email'];
    
    // Verificar si se subió una foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        // Obtener la imagen como blob
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    } else {
        $foto = null;
    }

    // Verificar que los campos no estén vacíos
    if (!empty($nombre) && !empty($puesto) && !empty($email)) {
        // Insertar en la base de datos
        try {
            $sql = "INSERT INTO empleados (nombre, puesto, email, foto) VALUES (:nombre, :puesto, :email, :foto)";
            $stmt = $conexion->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':puesto', $puesto);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);  // Long Blob para la foto

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $mensaje = "Empleado registrado con éxito.";
            } else {
                $mensaje = "Error al registrar el empleado.";
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
    <title>Registrar Empleado</title>
    <!-- Bootstrap local -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Registro de Empleado</h2>
        
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form action="registro_empleados.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto</label>
                <input type="text" class="form-control" id="puesto" name="puesto" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto del Empleado</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Registrar Empleado</button>
        </form>
    </div>

    <!-- Bootstrap JS local -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
