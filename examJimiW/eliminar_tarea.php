<?php
include 'php/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Eliminar la tarea por su ID
        $sql = "DELETE FROM tareas WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Redirigir al listado de tareas después de la eliminación
            header('Location: listar_tareas.php');
            exit();
        } else {
            echo "Error al eliminar la tarea.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de tarea no especificado.";
}
?>
