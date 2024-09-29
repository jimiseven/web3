<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Consulta SQL para obtener todos los clientes
$sql = "SELECT id, nombre, correo_electronico, telefono FROM clientes";
$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Listado de Clientes</h2>

        <?php if ($resultado->num_rows > 0): ?>
            <div class="list-group">
                <?php while($fila = $resultado->fetch_assoc()): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <!-- Información del cliente -->
                            <h5><?php echo $fila['nombre']; ?></h5>
                            <p>Correo: <?php echo $fila['correo_electronico']; ?></p>
                            <p>Teléfono: <?php echo $fila['telefono']; ?></p>
                        </div>

                        <!-- Botones para modificar y eliminar -->
                        <div>
                            <a href="modificar_cliente.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning btn-sm">Modificar</a>
                            <a href="eliminar_cliente.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">Eliminar</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No se encontraron clientes registrados.</div>
        <?php endif; ?>

    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
