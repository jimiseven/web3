<?php
// Incluir la conexión a la base de datos
include 'php/conexion.php';

// Verificar si se ha proporcionado el ID de la reserva para editar
if (isset($_GET['id'])) {
    $id_reserva = $_GET['id'];

    // Obtener la información actual de la reserva
    $sql_reserva = "SELECT * FROM reservas WHERE id = $id_reserva";
    $resultado_reserva = $conn->query($sql_reserva);
    $reserva = $resultado_reserva->fetch_assoc();

    // Obtener los datos de los clientes, mesas, y menús con nombres
    $clientes = $conn->query("SELECT id, nombre FROM clientes");
    $mesas = $conn->query("SELECT id, numero_mesa FROM mesas");
    $menus = $conn->query("SELECT id, nombre FROM menus");

    // Verificar si la reserva fue encontrada
    if (!$reserva) {
        echo "Error: Reserva no encontrada.";
        exit;
    }
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['cliente_id'];
    $mesa_id = $_POST['mesa_id'];
    $menu_id = $_POST['menu_id'];
    $hora_reserva = $_POST['hora_reserva'];
    $solicitudes_especiales = $_POST['solicitudes_especiales'];
    $confirmado = $_POST['confirmado'];

    // Actualizar la reserva en la base de datos
    $sql_update = "UPDATE reservas 
                   SET cliente_id = '$cliente_id', mesa_id = '$mesa_id', menu_id = '$menu_id', 
                       hora_reserva = '$hora_reserva', solicitudes_especiales = '$solicitudes_especiales', 
                       confirmado = '$confirmado' 
                   WHERE id = $id_reserva";

    if ($conn->query($sql_update) === TRUE) {
        // Redirigir al listado de reservas después de actualizar
        header("Location: listar_reservas.php");
        exit;
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
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
                <a href="registroCliente.php" class="list-group-item list-group-item-action">Registro Cliente</a>
                <a href="registroMesas.php" class="list-group-item list-group-item-action"> Registro Mesas</a>
                <a href="registrarPlatos.php" class="list-group-item list-group-item-action"> Registro Platos</a>
                <a href="registroReserva.php" class="list-group-item list-group-item-action"> Registro Reservas</a>
            </div>
        </div>
        <!-- Sidebar end -->
        <!-- Centro ini -->
        <div class="container mt-5">
            <h2 class="text-center">Editar Reserva</h2>

            <form action="" method="POST">
                <!-- Select para seleccionar Cliente -->
                <div class="mb-3">
                    <label for="cliente_id" class="form-label">Seleccionar Cliente</label>
                    <select class="form-control" id="cliente_id" name="cliente_id" required>
                        <option value="">Seleccione un cliente</option>
                        <?php while ($cliente = $clientes->fetch_assoc()): ?>
                            <option value="<?php echo $cliente['id']; ?>" <?php echo ($cliente['id'] == $reserva['cliente_id']) ? 'selected' : ''; ?>>
                                <?php echo $cliente['nombre']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Select para seleccionar Mesa -->
                <div class="mb-3">
                    <label for="mesa_id" class="form-label">Seleccionar Mesa</label>
                    <select class="form-control" id="mesa_id" name="mesa_id" required>
                        <option value="">Seleccione una mesa</option>
                        <?php while ($mesa = $mesas->fetch_assoc()): ?>
                            <option value="<?php echo $mesa['id']; ?>" <?php echo ($mesa['id'] == $reserva['mesa_id']) ? 'selected' : ''; ?>>
                                Mesa <?php echo $mesa['numero_mesa']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Select para seleccionar Menú -->
                <div class="mb-3">
                    <label for="menu_id" class="form-label">Seleccionar Menú</label>
                    <select class="form-control" id="menu_id" name="menu_id" required>
                        <option value="">Seleccione un menú</option>
                        <?php while ($menu = $menus->fetch_assoc()): ?>
                            <option value="<?php echo $menu['id']; ?>" <?php echo ($menu['id'] == $reserva['menu_id']) ? 'selected' : ''; ?>>
                                <?php echo $menu['nombre']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Campo para la hora de la reserva -->
                <div class="mb-3">
                    <label for="hora_reserva" class="form-label">Hora de la Reserva</label>
                    <input type="datetime-local" class="form-control" id="hora_reserva" name="hora_reserva" value="<?php echo date('Y-m-d\TH:i', strtotime($reserva['hora_reserva'])); ?>" required>
                </div>

                <!-- Campo para solicitudes especiales -->
                <div class="mb-3">
                    <label for="solicitudes_especiales" class="form-label">Solicitudes Especiales</label>
                    <textarea class="form-control" id="solicitudes_especiales" name="solicitudes_especiales" required><?php echo $reserva['solicitudes_especiales']; ?></textarea>
                </div>

                <!-- Radio buttons para confirmar la reserva -->
                <div class="mb-3">
                    <label class="form-label">¿Confirmar reserva?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="confirmado" id="confirmado_si" value="1" <?php echo ($reserva['confirmado'] == 1) ? 'checked' : ''; ?> required>
                        <label class="form-check-label" for="confirmado_si">Sí</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="confirmado" id="confirmado_no" value="0" <?php echo ($reserva['confirmado'] == 0) ? 'checked' : ''; ?> required>
                        <label class="form-check-label" for="confirmado_no">No</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Reserva</button>
            </form>
        </div>
        <!-- Centro end -->

        <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>