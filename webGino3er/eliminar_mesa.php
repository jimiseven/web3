<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Verificar si se ha pasado un ID de mesa
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta SQL para eliminar la mesa
    $sql = "DELETE FROM mesas WHERE id = $id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redirigir al listado de mesas con un mensaje de éxito
        header("Location: listado_mesas.php?mensaje=Mesa eliminada con éxito");
    } else {
        // Redirigir al listado de mesas con un mensaje de error
        header("Location: listado_mesas.php?mensaje=Error al eliminar la mesa");
    }
}

// Cerrar la conexión
$conn->close();
?>
