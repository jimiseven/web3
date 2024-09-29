<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Consulta SQL para obtener todas las reservas con detalles del cliente, mesa y menú
$sql = "SELECT 
            reservas.id AS reserva_id, 
            clientes.nombre AS cliente_nombre, 
            mesas.numero_mesa AS mesa_numero, 
            mesas.capacidad AS mesa_capacidad, 
            mesas.ubicacion AS mesa_ubicacion, 
            menus.nombre AS menu_nombre, 
            reservas.hora_reserva, 
            reservas.fecha_reserva, 
            reservas.confirmado 
        FROM reservas
        JOIN clientes ON reservas.cliente_id = clientes.id
        JOIN mesas ON reservas.mesa_id = mesas.id
        JOIN menus ON reservas.menu_id = menus.id";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Reservas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Listado de Reservas</h2>

        <?php if ($resultado->num_rows > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Mesa</th>
                        <th>Menú</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Confirmado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $fila['cliente_nombre']; ?></td>
                            <td>
                                Mesa #<?php echo $fila['mesa_numero']; ?> - Capacidad: <?php echo $fila['mesa_capacidad']; ?> - Ubicación: <?php echo ucfirst($fila['mesa_ubicacion']); ?>
                            </td>
                            <td><?php echo $fila['menu_nombre']; ?></td>
                            <td><?php echo $fila['fecha_reserva']; ?></td>
                            <td><?php echo $fila['hora_reserva']; ?></td>
                            <td><?php echo $fila['confirmado'] ? 'Sí' : 'No'; ?></td>
                            <td>
                                <a href="modificar_reserva.php?id=<?php echo $fila['reserva_id']; ?>" class="btn btn-warning btn-sm">Modificar</a>
                                <a href="eliminar_reserva.php?id=<?php echo $fila['reserva_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">No se encontraron reservas.</div>
        <?php endif; ?>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
