<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Consulta SQL para obtener todos los menús
$sql = "SELECT id, nombre, descripcion, url_imagen FROM menus";
$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Menús</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Listado de Menús Registrados</h2>

        <?php if ($resultado->num_rows > 0): ?>
            <div class="list-group">
                <?php while($fila = $resultado->fetch_assoc()): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <!-- Miniatura de la imagen -->
                            <img src="<?php echo $fila['url_imagen']; ?>" alt="Miniatura" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; margin-right: 15px;">
                            <div>
                                <!-- Información del menú -->
                                <h5><?php echo $fila['nombre']; ?></h5>
                                <p><?php echo $fila['descripcion']; ?></p>
                            </div>
                        </div>

                        <!-- Botones para modificar y eliminar -->
                        <div>
                            <a href="modificar_menu.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning btn-sm">Modificar</a>
                            <a href="eliminar_menu.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este menú?');">Eliminar</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No se encontraron menús registrados.</div>
        <?php endif; ?>

    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
