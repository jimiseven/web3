<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Variable para almacenar mensajes de éxito o error
$mensaje = "";

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $numero_mesa = $_POST['numero_mesa'];
    $capacidad = $_POST['capacidad'];
    $ubicacion = $_POST['ubicacion'];  // Obtén la opción seleccionada

    // Validar los datos antes de insertarlos
    if (!empty($numero_mesa) && !empty($capacidad) && !empty($ubicacion)) {
        // Preparar la consulta SQL
        $sql = "INSERT INTO mesas (numero_mesa, capacidad, ubicacion) VALUES ('$numero_mesa', '$capacidad', '$ubicacion')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Nueva mesa registrada con éxito";
        } else {
            $mensaje = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $mensaje = "Por favor, rellena todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Mesas</title>
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
                    <h2>Registro Mesa</h2>
                </div>
                <div class="col-md-4 text-right ml-auto">
                    <a href="listado_mesas.php" class="btn btn-primary">Ver Listado de Mesas</a>
                </div>
            </div>
            <?php
            // Mostrar mensaje de éxito o error si existe
            if (!empty($mensaje)) {
                echo '<div class="alert alert-info">' . $mensaje . '</div>';
            }
            ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="numero_mesa">Número de Mesa:</label>
                    <input type="number" class="form-control" id="numero_mesa" name="numero_mesa" placeholder="Ingresa el número de la mesa" required>
                </div>
                <div class="form-group">
                    <label for="capacidad">Capacidad:</label>
                    <input type="number" class="form-control" id="capacidad" name="capacidad" placeholder="Ingresa la capacidad de la mesa" required>
                </div>
                <div class="form-group">
                    <label>Ubicación:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ubicacion" id="ubicacionJardin" value="Jardin" required>
                        <label class="form-check-label" for="ubicacionJardin">Jardín</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ubicacion" id="ubicacionInterior" value="Interior" required>
                        <label class="form-check-label" for="ubicacionInterior">Interior</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ubicacion" id="ubicacionTerraza" value="Terraza" required>
                        <label class="form-check-label" for="ubicacionTerraza">Terraza</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Registrar Mesa</button>
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