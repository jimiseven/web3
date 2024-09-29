<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Consulta SQL para obtener todas las mesas
$sql = "SELECT id, numero_mesa, capacidad, ubicacion FROM mesas";
$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Mesas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Listado de Mesas</h2>

        <?php if ($resultado->num_rows > 0): ?>
            <div class="list-group">
                <?php while($fila = $resultado->fetch_assoc()): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <!-- Información de la mesa -->
                            <h5>Mesa #<?php echo $fila['numero_mesa']; ?></h5>
                            <p>Capacidad: <?php echo $fila['capacidad']; ?></p>
                            <p>Ubicación: <?php echo $fila['ubicacion']; ?></p>
                        </div>

                        <!-- Botones para modificar y eliminar -->
                        <div>
                            <a href="modificar_mesa.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning btn-sm">Modificar</a>
                            <a href="eliminar_mesa.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta mesa?');">Eliminar</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No se encontraron mesas registradas.</div>
        <?php endif; ?>

    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
