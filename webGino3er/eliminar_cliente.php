<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Verificar si se ha pasado un ID de cliente
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta SQL para eliminar el cliente
    $sql = "DELETE FROM clientes WHERE id = $id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redirigir al listado de clientes con un mensaje de éxito
        header("Location: listado_clientes.php?mensaje=Cliente eliminado con éxito");
    } else {
        // Redirigir al listado de clientes con un mensaje de error
        header("Location: listado_clientes.php?mensaje=Error al eliminar el cliente");
    }
}

// Cerrar la conexión
$conn->close();
?>
