<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Obtener el ID de la reserva desde la URL
$reserva_id = $_GET['id'];

// Verificar si el formulario de modificación ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recorrer los detalles enviados para actualizar las cantidades
    foreach ($_POST['detalle_id'] as $index => $detalle_id) {
        $cantidad = $_POST['cantidad'][$index];
        
        // Actualizar la cantidad en la tabla detalle_reserva
        $sqlUpdate = "UPDATE detalle_reserva SET cantidad = '$cantidad' WHERE id = '$detalle_id'";
        $conn->query($sqlUpdate);
    }
    
    // Mensaje de éxito
    $mensaje = "Detalles de la reserva actualizados con éxito.";
}

// Consulta SQL para obtener los detalles de la reserva seleccionada
$sql = "SELECT 
            detalle_reserva.id AS detalle_id,
            clientes.nombre AS cliente_nombre,
            mesas.numero_mesa AS mesa_numero,
            menus.nombre AS menu_nombre,
            detalle_reserva.cantidad,
            reservas.fecha_reserva,
            reservas.hora_reserva
        FROM detalle_reserva
        JOIN reservas ON detalle_reserva.reserva_id = reservas.id
        JOIN clientes ON reservas.cliente_id = clientes.id
        JOIN mesas ON reservas.mesa_id = mesas.id
        JOIN menus ON detalle_reserva.menu_id = menus.id
        WHERE reservas.id = '$reserva_id'";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Reserva</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2>Detalle de la Reserva</h2>
            </div>
            <div class="col-md-4 text-right ml-auto">
                <a href="listado_detalle_reserva.php" class="btn btn-secondary">Volver al Listado</a>
            </div>
        </div>

        <?php
        // Mostrar mensaje de éxito si existe
        if (isset($mensaje)) {
            echo '<div class="alert alert-success">' . $mensaje . '</div>';
        }
        ?>

        <form action="" method="POST">
            <?php if ($resultado->num_rows > 0): ?>
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Mesa</th>
                            <th>Plato</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $fila['cliente_nombre']; ?></td>
                                <td>Mesa #<?php echo $fila['mesa_numero']; ?></td>
                                <td><?php echo $fila['menu_nombre']; ?></td>
                                <td>
                                    <!-- Campo editable para la cantidad -->
                                    <input type="hidden" name="detalle_id[]" value="<?php echo $fila['detalle_id']; ?>">
                                    <input type="number" name="cantidad[]" value="<?php echo $fila['cantidad']; ?>" class="form-control" min="1">
                                </td>
                                <td><?php echo $fila['fecha_reserva']; ?></td>
                                <td><?php echo $fila['hora_reserva']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary mt-3">Actualizar Detalles</button>
            <?php else: ?>
                <div class="alert alert-info">No se encontraron detalles para esta reserva.</div>
            <?php endif; ?>
        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>
