<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Variable para almacenar mensajes de éxito o error
$mensaje = "";

// Obtener las reservas disponibles
$sqlReservas = "SELECT reservas.id AS reserva_id, clientes.nombre AS cliente_nombre, mesas.numero_mesa, reservas.fecha_reserva, reservas.hora_reserva 
                FROM reservas 
                JOIN clientes ON reservas.cliente_id = clientes.id
                JOIN mesas ON reservas.mesa_id = mesas.id";
$resultadoReservas = $conn->query($sqlReservas);

// Obtener los platos disponibles (hasta 4 platos)
$sqlPlatos = "SELECT id, nombre FROM menus LIMIT 4";
$resultadoPlatos = $conn->query($sqlPlatos);

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reserva_id = $_POST['reserva_id'];
    $platos = $_POST['plato_id']; // Array con los IDs de los platos seleccionados
    $cantidades = $_POST['cantidad']; // Array con las cantidades de cada plato

    // Validar que se haya seleccionado una reserva y al menos un plato
    if (!empty($reserva_id) && !empty($platos) && !empty($cantidades)) {
        // Insertar los detalles de la orden en la tabla 'detalle_reserva'
        for ($i = 0; $i < count($platos); $i++) {
            $plato_id = $platos[$i];
            $cantidad = $cantidades[$i];
            if (!empty($cantidad) && $cantidad > 0) {
                // Insertar cada plato en la tabla detalle_reserva
                $sqlDetalle = "INSERT INTO detalle_reserva (reserva_id, menu_id, cantidad) VALUES ('$reserva_id', '$plato_id', '$cantidad')";
                $conn->query($sqlDetalle);
            }
        }

        $mensaje = "Orden registrada con éxito en detalle_reserva";
    } else {
        $mensaje = "Por favor, selecciona una reserva y al menos un plato.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Orden</title>
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
                    <h2>Registro de Órdenes</h2>
                </div>
                <div class="col-md-4 text-right ml-auto">
                    <a href="listado_ordenes.php" class="btn btn-primary">Ver Listado Órdenes</a>
                </div>
            </div>

            <?php
            // Mostrar mensaje de éxito o error si existe
            if (!empty($mensaje)) {
                echo '<div class="alert alert-info">' . $mensaje . '</div>';
            }
            ?>

            <form action="" method="POST">
                <!-- Selección de la Reserva -->
                <div class="form-group">
                    <label for="reserva_id">Selecciona la Reserva:</label>
                    <select class="form-control" id="reserva_id" name="reserva_id" required onchange="cargarDatosReserva(this)">
                        <option value="">Selecciona una reserva</option>
                        <?php while ($reserva = $resultadoReservas->fetch_assoc()): ?>
                            <option value="<?php echo $reserva['reserva_id']; ?>" data-mesa="<?php echo $reserva['numero_mesa']; ?>" data-fecha="<?php echo $reserva['fecha_reserva']; ?>" data-hora="<?php echo $reserva['hora_reserva']; ?>">
                                Reserva de <?php echo $reserva['cliente_nombre']; ?> - Mesa #<?php echo $reserva['numero_mesa']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Mostrar los datos de la reserva seleccionada -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mesa">Mesa:</label>
                            <input type="text" class="form-control" id="mesa" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <input type="text" class="form-control" id="fecha" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hora">Hora:</label>
                            <input type="text" class="form-control" id="hora" readonly>
                        </div>
                    </div>
                </div>

                <!-- Selección de Platos y Cantidades -->
                <div class="form-group">
                    <label for="platos">Selecciona los Platos:</label>
                    <?php while ($plato = $resultadoPlatos->fetch_assoc()): ?>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="plato_id[]" value="<?php echo $plato['id']; ?>" id="plato_<?php echo $plato['id']; ?>">
                                    <label class="form-check-label" for="plato_<?php echo $plato['id']; ?>">
                                        <?php echo $plato['nombre']; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="cantidad[]" placeholder="Cantidad" min="1">
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Registrar Orden</button>
            </form>
        </div>
        <!-- centro end -->

        <script src="js/bootstrap.min.js"></script>
        <script>
            // Cargar automáticamente los datos de la reserva seleccionada
            function cargarDatosReserva(select) {
                var option = select.options[select.selectedIndex];
                document.getElementById('mesa').value = option.getAttribute('data-mesa');
                document.getElementById('fecha').value = option.getAttribute('data-fecha');
                document.getElementById('hora').value = option.getAttribute('data-hora');
            }
        </script>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>
