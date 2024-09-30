<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Verificar si se ha pasado un ID de mesa
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los detalles de la mesa actual
    $sql = "SELECT * FROM mesas WHERE id = $id";
    $resultado = $conn->query($sql);
    $mesa = $resultado->fetch_assoc();
}

// Verificar si el formulario de modificación fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero_mesa = $_POST['numero_mesa'];
    $capacidad = $_POST['capacidad'];
    $ubicacion = $_POST['ubicacion'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE mesas SET numero_mesa = '$numero_mesa', capacidad = '$capacidad', ubicacion = '$ubicacion' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirigir al listado de mesas con un mensaje de éxito
        header("Location: listado_mesas.php?mensaje=Mesa modificada con éxito");
    } else {
        // Mostrar mensaje de error
        echo "Error al modificar la mesa: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Mesa</title>
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
            </div>
        </div>
        <!-- Sidebar end -->
        <!-- centro ini-->
        <div class="container">
            <div class="row align-items-center mt-5">
                <div class="col-md-8">
                    <h2>Modificar Mesa</h2>
                </div>
            </div>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="numero_mesa">Número de Mesa:</label>
                    <input type="number" class="form-control" id="numero_mesa" name="numero_mesa" value="<?php echo $mesa['numero_mesa']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="capacidad">Capacidad:</label>
                    <input type="number" class="form-control" id="capacidad" name="capacidad" value="<?php echo $mesa['capacidad']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Ubicación:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ubicacion" id="ubicacionJardin" value="Jardin" <?php if ($mesa['ubicacion'] == 'jardin') echo 'checked'; ?>>
                        <label class="form-check-label" for="ubicacionJardin">Jardín</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ubicacion" id="ubicacionInterior" value="Interior" <?php if ($mesa['ubicacion'] == 'interior') echo 'checked'; ?>>
                        <label class="form-check-label" for="ubicacionInterior">Interior</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ubicacion" id="ubicacionTerraza" value="Terraza" <?php if ($mesa['ubicacion'] == 'terraza') echo 'checked'; ?>>
                        <label class="form-check-label" for="ubicacionTerraza">Terraza</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Modificar Mesa</button>
            </form>
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