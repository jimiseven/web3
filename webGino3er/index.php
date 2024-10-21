<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Consulta SQL para obtener los platos (menús) disponibles
$sqlPlatos = "SELECT nombre, descripcion, url_imagen FROM menus";
$resultadoPlatos = $conn->query($sqlPlatos);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialidades</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css" />
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
                <a href="listado_menus.php" class="list-group-item list-group-item-action">Orden</a>
            </div>
        </div>
        <!-- Sidebar end -->
        <!-- centro ini-->
        <div class="container">
            <div class="row align-items-center mt-5">
                <div class="col-md-8">
                    <h2>Especialidades</h2>
                </div>
            </div>

            <div class="row mt-4">
                <?php if ($resultadoPlatos->num_rows > 0): ?>
                    <?php while ($plato = $resultadoPlatos->fetch_assoc()): ?>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="<?php echo $plato['url_imagen']; ?>" class="card-img-top" alt="<?php echo $plato['nombre']; ?>" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $plato['nombre']; ?></h5>
                                    <p class="card-text"><?php echo $plato['descripcion']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-md-12">
                        <p>No hay especialidades disponibles en este momento.</p>
                    </div>
                <?php endif; ?>
            </div>
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