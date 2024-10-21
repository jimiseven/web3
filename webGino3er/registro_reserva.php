<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Variable para almacenar mensajes de éxito o error
$mensaje = "";

// Obtener los clientes disponibles
$sqlClientes = "SELECT id, nombre FROM clientes";
$resultadoClientes = $conn->query($sqlClientes);

// Obtener las mesas disponibles
$sqlMesas = "SELECT id, numero_mesa, capacidad, ubicacion FROM mesas";
$resultadoMesas = $conn->query($sqlMesas);

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $mesa_id = $_POST['mesa_id'];
    $hora_reserva = $_POST['hora_reserva'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $confirmado = isset($_POST['confirmado']) ? 1 : 0; // Checkbox

    // Validar los datos antes de insertarlos
    if (!empty($cliente_id) && !empty($mesa_id) && !empty($hora_reserva) && !empty($fecha_reserva)) {
        // Preparar la consulta SQL para insertar la reserva
        $sql = "INSERT INTO reservas (cliente_id, mesa_id, hora_reserva, fecha_reserva, confirmado) 
                VALUES ('$cliente_id', '$mesa_id', '$hora_reserva', '$fecha_reserva', '$confirmado')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Nueva reserva registrada con éxito";
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
    <title>Registro de Reserva</title>
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
                    <h2>Registro de Reservas</h2>
                </div>
                <div class="col-md-4 text-right ml-auto">
                    <a href="listado_reservas.php" class="btn btn-primary">Ver Listado Reservas</a>
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
                    <label for="cliente_id">Selecciona el Cliente:</label>
                    <select class="form-control" id="cliente_id" name="cliente_id" required onchange="redirectToClientForm(this.value)">
                        <option value="">Selecciona un cliente</option>
                        <?php while ($cliente = $resultadoClientes->fetch_assoc()): ?>
                            <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nombre']; ?></option>
                        <?php endwhile; ?>
                        <option value="nuevo">Registrar nuevo cliente</option>
                    </select>
                </div>
                <!-- Fila para Mesa de la Reserva -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mesa_id">Selecciona la Mesa:</label>
                            <select class="form-control" id="mesa_id" name="mesa_id" required>
                                <option value="">Selecciona una mesa</option>
                                <?php while ($mesa = $resultadoMesas->fetch_assoc()): ?>
                                    <option value="<?php echo $mesa['id']; ?>">
                                        Mesa #<?php echo $mesa['numero_mesa']; ?> - Capacidad: <?php echo $mesa['capacidad']; ?> - Ubicación: <?php echo ucfirst($mesa['ubicacion']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Fila para Hora y Fecha de la Reserva -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hora_reserva">Hora de la Reserva:</label>
                            <input type="time" class="form-control" id="hora_reserva" name="hora_reserva" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_reserva">Fecha de la Reserva:</label>
                            <input type="date" class="form-control" id="fecha_reserva" name="fecha_reserva" required>
                        </div>
                    </div>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="confirmado" name="confirmado">
                    <label class="form-check-label" for="confirmado">Confirmar Reserva</label>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Registrar Reserva</button>
            </form>
        </div>
        <!-- centro end -->

    <script src="js/bootstrap.min.js"></script>

    <script>
        // Redirigir a la página de registro de clientes si se selecciona la opción "Registrar nuevo cliente"
        function redirectToClientForm(value) {
            if (value === "nuevo") {
                window.location.href = "registro_cliente.php"; // Cambiar a la ruta real del formulario de registro de clientes
            }
        }
    </script>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>
