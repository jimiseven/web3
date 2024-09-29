<?php
include 'php/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Eliminar el empleado por su ID
        $sql = "DELETE FROM empleados WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            header('Location: listar_empleados.php');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
