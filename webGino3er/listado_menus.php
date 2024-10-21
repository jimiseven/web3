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
    <div class="d-flex">
        <!-- Sidebar ini -->
        <div class="bg-dark border-rigth p-3" id="sidebar">
            <h3 class="text-light">RESTAURANT EL SUR</h3>
            <hr class="text-white" />
            <div class="list-group list-reset">
                <a href="listado_clientes.php" class="list-group-item list-group-item-action">Cliente</a>
                <a href="listado_reservas.php" class="list-group-item list-group-item-action">Reservas</a>
                <a href="listado_mesas.php" class="list-group-item list-group-item-action">Mesas</a>
                <a href="listado_menus.php" class="list-group-item list-group-item-action">Platos</a>
                <a href="listado_detalle_reserva.php" class="list-group-item list-group-item-action">Ordenes</a>
            </div>
        </div>
        <!-- Sidebar end -->
        <!-- centro ini-->
        <div class="container">
            <div class="row align-items-center mt-5">
                <div class="col-md-8">
                    <h2>Listado menus</h2>
                </div>
                <div class="col-md-4 text-right ml-auto">
                    <a href="registro_menu.php" class="btn btn-primary">Registro menu</a>
                </div>
            </div>
            <?php if ($resultado->num_rows > 0): ?>
                <div class="list-group">
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
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
        <!-- centro end -->
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>