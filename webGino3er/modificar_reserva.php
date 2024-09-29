<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Verificar si se ha pasado un ID de reserva
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los detalles de la reserva actual
    $sql = "SELECT * FROM reservas WHERE id = $id";
    $resultado = $conn->query($sql);
    $reserva = $resultado->fetch_assoc();

    // Obtener los clientes disponibles
    $sqlClientes = "SELECT id, nombre FROM clientes";
    $resultadoClientes = $conn->query($sqlClientes);

    // Obtener las mesas disponibles
    $sqlMesas = "SELECT id, numero_mesa, capacidad, ubicacion FROM mesas";
    $resultadoMesas = $conn->query($sqlMesas);

    // Obtener los menús disponibles
    $sqlMenus = "SELECT id, nombre FROM menus";
    $resultadoMenus = $conn->query($sqlMenus);
}

// Verificar si el formulario de modificación fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $mesa_id = $_POST['mesa_id'];
    $menu_id = $_POST['menu_id'];
    $hora_reserva = $_POST['hora_reserva'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $confirmado = isset($_POST['confirmado']) ? 1 : 0;

    // Actualizar los datos en la base de datos
    $sql = "UPDATE reservas 
            SET cliente_id = '$cliente_id', 
                mesa_id = '$mesa_id', 
                menu_id = '$menu_id', 
                hora_reserva = '$hora_reserva', 
                fecha_reserva = '$fecha_reserva', 
                confirmado = '$confirmado' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirigir al listado de reservas con un mensaje de éxito
        header("Location: listado_reservas.php?mensaje=Reserva modificada con éxito");
    } else {
        echo "Error al modificar la reserva: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Reserva</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Modificar Reserva</h2>

        <form action="" method="POST">
            <!-- Seleccionar cliente -->
            <div class="form-group">
                <label for="cliente_id">Selecciona el Cliente:</label>
                <select class="form-control" id="cliente_id" name="cliente_id" required>
                    <option value="">Selecciona un cliente</option>
                    <?php while ($cliente = $resultadoClientes->fetch_assoc()): ?>
                        <option value="<?php echo $cliente['id']; ?>" <?php if ($cliente['id'] == $reserva['cliente_id']) echo 'selected'; ?>>
                            <?php echo $cliente['nombre']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Fila para Mesa y Menu de la Reserva -->
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu_id">Selecciona el Menú:</label>
                        <select class="form-control" id="menu_id" name="menu_id" required>
                            <option value="">Selecciona un menú</option>
                            <?php while ($menu = $resultadoMenus->fetch_assoc()): ?>
                                <option value="<?php echo $menu['id']; ?>"><?php echo $menu['nombre']; ?></option>
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

            <!-- Confirmación -->
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="confirmado" name="confirmado" <?php if ($reserva['confirmado']) echo 'checked'; ?>>
                <label class="form-check-label" for="confirmado">Confirmar Reserva</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Modificar Reserva</button>
        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>