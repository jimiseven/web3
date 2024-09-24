<?php
// Incluir la conexión desde el archivo conexion.php
include 'php/conexion.php';

// Obtener datos de las tablas relacionadas
$clientes = $conn->query("SELECT id, nombre FROM clientes");
$mesas = $conn->query("SELECT id, numero_mesa FROM mesas");
$menus = $conn->query("SELECT id, nombre FROM menus");

// Procesar el formulario si ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $cliente_id = $_POST['cliente_id'];
    $mesa_id = $_POST['mesa_id'];
    $menu_id = $_POST['menu_id'];
    $hora_reserva = $_POST['hora_reserva'];
    $solicitudes_especiales = isset($_POST['solicitudes_especiales']) ? $_POST['solicitudes_especiales'] : '';
    $confirmado = $_POST['confirmado'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO reservas (cliente_id, mesa_id, menu_id, hora_reserva, solicitudes_especiales, confirmado) 
            VALUES ('$cliente_id', '$mesa_id', '$menu_id', '$hora_reserva', '$solicitudes_especiales', '$confirmado')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Reserva registrada correctamente.";
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar ini -->
        <div class="bg-dark border-rigth p-3" id="sidebar">
            <h3 class="text-light">RESTAURANT EL SUR</h3>
            <hr class="text-white" />
            <div class="list-group list-reset">
                <a href="registroCliente.php" class="list-group-item list-group-item-action">Registro Cliente</a>
                <a href="registroMesas.php" class="list-group-item list-group-item-action"> Registro Mesas</a>
                <a href="registrarPlatos.php" class="list-group-item list-group-item-action"> Registro Platos</a>
                <a href="registroReserva.php" class="list-group-item list-group-item-action"> Registro Reservas</a>
            </div>
        </div>
        <!-- Sidebar end -->

        <!-- centro ini-->
        <div class="container mt-5">
            <h2 class="text-center">Registro de Reservas</h2>

            <!-- Mostrar mensaje si el formulario fue procesado -->
            <?php if (isset($mensaje)): ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <!-- Select para seleccionar Cliente -->
                <div class="mb-3">
                    <label for="cliente_id" class="form-label">Seleccionar Cliente</label>
                    <select class="form-control" id="cliente_id" name="cliente_id" required>
                        <option value="">Seleccione un cliente</option>
                        <?php while ($cliente = $clientes->fetch_assoc()): ?>
                            <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nombre']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Select para seleccionar Mesa -->
                <div class="mb-3">
                    <label for="mesa_id" class="form-label">Seleccionar Mesa</label>
                    <select class="form-control" id="mesa_id" name="mesa_id" required>
                        <option value="">Seleccione una mesa</option>
                        <?php while ($mesa = $mesas->fetch_assoc()): ?>
                            <option value="<?php echo $mesa['id']; ?>">Mesa <?php echo $mesa['numero_mesa']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Select para seleccionar Menú -->
                <div class="mb-3">
                    <label for="menu_id" class="form-label">Seleccionar Menú</label>
                    <select class="form-control" id="menu_id" name="menu_id" required>
                        <option value="">Seleccione un menú</option>
                        <?php while ($menu = $menus->fetch_assoc()): ?>
                            <option value="<?php echo $menu['id']; ?>"><?php echo $menu['nombre']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Campo para la hora de la reserva -->
                <div class="mb-3">
                    <label for="hora_reserva" class="form-label">Hora de la Reserva</label>
                    <input type="datetime-local" class="form-control" id="hora_reserva" name="hora_reserva" required>
                </div>

                <!-- Checkbox para solicitudes especiales -->
                <div class="mb-3">
                    <label class="form-label">Solicitudes Especiales</label><br>
                    <textarea class="form-control" name="solicitudes_especiales" id="solicitudes_especiales"></textarea>
                </div>

                <!-- Radio buttons para confirmar la reserva -->
                <div class="mb-3">
                    <label class="form-label">¿Confirmar reserva?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="confirmado" id="confirmado_si" value="1" required>
                        <label class="form-check-label" for="confirmado_si">Sí</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="confirmado" id="confirmado_no" value="0" required>
                        <label class="form-check-label" for="confirmado_no">No</label>
                    </div>
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="btn btn-primary">Registrar Reserva</button>
            </form>
        </div>
        <!-- centro end -->
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>
