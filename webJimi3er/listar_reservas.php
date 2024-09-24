<?php
// Incluir la conexión a la base de datos
include 'php/conexion.php';

// Obtener todas las reservas con sus relaciones
$sql = "SELECT r.id, r.hora_reserva, r.solicitudes_especiales, r.confirmado, 
        c.nombre AS cliente, m.numero_mesa AS mesa, me.nombre AS menu
        FROM reservas r
        JOIN clientes c ON r.cliente_id = c.id
        JOIN mesas m ON r.mesa_id = m.id
        JOIN menus me ON r.menu_id = me.id";
$reservas = $conn->query($sql);

// Eliminar reserva si se ha enviado una solicitud de eliminación
if (isset($_GET['eliminar'])) {
    $id_reserva = $_GET['eliminar'];
    $conn->query("DELETE FROM reservas WHERE id = $id_reserva");
    header("Location: listar_reservas.php");
    exit;
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
        <!-- Centro ini -->
        <div class="container mt-5">
            <h2 class="text-center">Listado de Reservas</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Mesa</th>
                        <th>Menú</th>
                        <th>Hora de Reserva</th>
                        <th>Solicitudes Especiales</th>
                        <th>Confirmado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($reserva = $reservas->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $reserva['cliente']; ?></td>
                            <td>Mesa <?php echo $reserva['mesa']; ?></td>
                            <td><?php echo $reserva['menu']; ?></td>
                            <td><?php echo $reserva['hora_reserva']; ?></td>
                            <td><?php echo $reserva['solicitudes_especiales']; ?></td>
                            <td><?php echo $reserva['confirmado'] ? 'Sí' : 'No'; ?></td>
                            <td>
                                <!-- Botón para editar -->
                                <a href="editar_reserva.php?id=<?php echo $reserva['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <!-- Botón para eliminar -->
                                <a href="listar_reservas.php?eliminar=<?php echo $reserva['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <!-- Centro end -->
        <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>