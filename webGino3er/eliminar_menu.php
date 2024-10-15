<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Verificar si se ha pasado un ID de menú
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta SQL para eliminar el menú
    $sql = "DELETE FROM menus WHERE id = $id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redirigir al listado de menús con un mensaje de éxito
        header("Location: listado_menus.php?mensaje=Menu eliminado con éxito");
    } else {
        // Redirigir al listado de menús con un mensaje de error
        header("Location: listado_menus.php?mensaje=Error al eliminar el menú");
    }
}

// Cerrar la conexión
$conn->close();
?>
