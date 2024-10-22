<?php
include 'php/conexion.php'; // Incluir la conexión a la base de datos

if (isset($_GET['tarea_id'])) {
    $tarea_id = $_GET['tarea_id'];

    // Consulta SQL para eliminar todas las asignaciones de equipos para la tarea
    $sql = "DELETE FROM tarea_equipo WHERE tarea_id = :tarea_id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':tarea_id', $tarea_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirigir de nuevo a la lista de asignaciones tras eliminar
        header("Location: listar_asignaciones.php");
        exit;
    } else {
        echo "Error al eliminar la asignación.";
    }
} else {
    echo "ID de tarea no proporcionado.";
}
?>
