<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Variable para almacenar mensajes de éxito o error
$mensaje = "";

// Obtener las mesas disponibles
$sqlMesas = "SELECT id, numero_mesa, capacidad, ubicacion FROM mesas";
$resultadoMesas = $conn->query($sqlMesas);

// Obtener los menús disponibles
$sqlMenus = "SELECT id, nombre FROM menus";
$resultadoMenus = $conn->query($sqlMenus);

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_POST['cliente_id'];  // Suponiendo que este valor es proporcionado
    $mesa_id = $_POST['mesa_id'];
    $menu_id = $_POST['menu_id'];
    $hora_reserva = $_POST['hora_reserva'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $confirmado = isset($_POST['confirmado']) ? 1 : 0; // Checkbox

    // Validar los datos antes de insertarlos
    if (!empty($cliente_id) && !empty($mesa_id) && !empty($menu_id) && !empty($hora_reserva) && !empty($fecha_reserva)) {
        // Preparar la consulta SQL
        $sql = "INSERT INTO reservas (cliente_id, mesa_id, menu_id, hora_reserva, fecha_reserva, confirmado) 
                VALUES ('$cliente_id', '$mesa_id', '$menu_id', '$hora_reserva', '$fecha_reserva', '$confirmado')";

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
    <div class="container mt-5">
        <h2 class="mb-4">Registro de Reservas</h2>

        <?php
        // Mostrar mensaje de éxito o error si existe
        if (!empty($mensaje)) {
            echo '<div class="alert alert-info">' . $mensaje . '</div>';
        }
        ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="cliente_id">ID del Cliente:</label>
                <input type="number" class="form-control" id="cliente_id" name="cliente_id" placeholder="Ingresa el ID del cliente" required>
            </div>
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
            <div class="form-group">
                <label for="menu_id">Selecciona el Menú:</label>
                <select class="form-control" id="menu_id" name="menu_id" required>
                    <option value="">Selecciona un menú</option>
                    <?php while ($menu = $resultadoMenus->fetch_assoc()): ?>
                        <option value="<?php echo $menu['id']; ?>"><?php echo $menu['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="hora_reserva">Hora de la Reserva:</label>
                <input type="time" class="form-control" id="hora_reserva" name="hora_reserva" required>
            </div>
            <div class="form-group">
                <label for="fecha_reserva">Fecha de la Reserva:</label>
                <input type="date" class="form-control" id="fecha_reserva" name="fecha_reserva" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="confirmado" name="confirmado">
                <label class="form-check-label" for="confirmado">Confirmar Reserva</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Registrar Reserva</button>
        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
