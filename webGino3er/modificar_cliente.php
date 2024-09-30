<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Verificar si se ha pasado un ID de cliente
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los detalles del cliente actual
    $sql = "SELECT * FROM clientes WHERE id = $id";
    $resultado = $conn->query($sql);
    $cliente = $resultado->fetch_assoc();
}

// Verificar si el formulario de modificación fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo_electronico'];
    $telefono = $_POST['telefono'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE clientes SET nombre = '$nombre', correo_electronico = '$correo', telefono = '$telefono' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirigir al listado de clientes con un mensaje de éxito
        header("Location: listado_clientes.php?mensaje=Cliente modificado con éxito");
    } else {
        // Mostrar mensaje de error
        echo "Error al modificar el cliente: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cliente</title>
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
                    <h2>Registro de Clientes</h2>
                </div>
            </div>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $cliente['nombre']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="correo_electronico">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?php echo $cliente['correo_electronico']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $cliente['telefono']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Modificar Cliente</button>
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