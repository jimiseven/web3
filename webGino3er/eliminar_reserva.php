<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Verificar si se ha pasado un ID de reserva
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta SQL para eliminar la reserva
    $sql = "DELETE FROM reservas WHERE id = $id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redirigir al listado de reservas con un mensaje de éxito
        header("Location: listado_reservas.php?mensaje=Reserva eliminada con éxito");
    } else {
        // Redirigir al listado de reservas con un mensaje de error
        header("Location: listado_reservas.php?mensaje=Error al eliminar la reserva");
    }
}

// Cerrar la conexión
$conn->close();
?>
