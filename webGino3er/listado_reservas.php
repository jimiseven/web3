<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Consulta SQL para obtener todas las reservas con detalles del cliente, mesa y menús
$sql = "SELECT 
            reservas.id AS reserva_id, 
            clientes.nombre AS cliente_nombre, 
            mesas.numero_mesa AS mesa_numero, 
            mesas.capacidad AS mesa_capacidad, 
            mesas.ubicacion AS mesa_ubicacion, 
            GROUP_CONCAT(menus.nombre SEPARATOR ', ') AS menu_nombres, 
            reservas.hora_reserva, 
            reservas.fecha_reserva, 
            reservas.confirmado 
        FROM reservas
        JOIN clientes ON reservas.cliente_id = clientes.id
        JOIN mesas ON reservas.mesa_id = mesas.id
        LEFT JOIN detalle_reserva ON reservas.id = detalle_reserva.reserva_id
        LEFT JOIN menus ON detalle_reserva.menu_id = menus.id
        GROUP BY reservas.id";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Reservas</title>
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
                <a href="listado_detalle_reserva.php" class="list-group-item list-group-item-action">Ordenes</a>
            </div>
        </div>
        <!-- Sidebar end -->
        <!-- centro ini-->
        <div class="container mt-5">
            <div class="row align-items-center mt-5">
                <div class="col-md-8">
                    <h2>Listado reservas</h2>
                </div>
                <div class="col-md-4 text-right ml-auto">
                    <a href="registro_reserva.php" class="btn btn-primary">Registro reserva</a>
                </div>
            </div>
            <?php if ($resultado->num_rows > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Mesa</th>
                            <th>Menús</th>
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
                                <td><?php echo $fila['menu_nombres']; ?></td>
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
        <!-- centro end -->

        <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>
