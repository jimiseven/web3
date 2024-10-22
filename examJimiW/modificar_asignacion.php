<?php
include 'php/conexion.php'; // Incluir la conexión a la base de datos

if (isset($_GET['tarea_id'])) {
    $tarea_id = $_GET['tarea_id'];

    // Obtener los datos actuales de la tarea y los equipos asignados
    $sql = "
        SELECT t.nombre AS tarea_nombre, GROUP_CONCAT(e.id SEPARATOR ',') AS equipo_ids
        FROM tarea_equipo te
        INNER JOIN tareas t ON te.tarea_id = t.id
        INNER JOIN equipos e ON te.equipo_id = e.id
        WHERE t.id = :tarea_id
        GROUP BY t.id
    ";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':tarea_id', $tarea_id, PDO::PARAM_INT);
    $stmt->execute();
    $asignacion = $stmt->fetch(PDO::FETCH_ASSOC);

    // Obtener la lista de equipos disponibles
    $equipos_sql = "SELECT * FROM equipos";
    $equipos_resultado = $conexion->query($equipos_sql);
    $equipos = $equipos_resultado->fetchAll(PDO::FETCH_ASSOC);

    // Si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Se reciben los equipos seleccionados
        $nuevo_equipo_ids = $_POST['equipos'];

        // Eliminar las asignaciones actuales para la tarea
        $delete_sql = "DELETE FROM tarea_equipo WHERE tarea_id = :tarea_id";
        $stmt = $conexion->prepare($delete_sql);
        $stmt->bindParam(':tarea_id', $tarea_id, PDO::PARAM_INT);
        $stmt->execute();

        // Insertar las nuevas asignaciones de equipos
        foreach ($nuevo_equipo_ids as $equipo_id) {
            $insert_sql = "INSERT INTO tarea_equipo (tarea_id, equipo_id) VALUES (:tarea_id, :equipo_id)";
            $stmt = $conexion->prepare($insert_sql);
            $stmt->bindParam(':tarea_id', $tarea_id, PDO::PARAM_INT);
            $stmt->bindParam(':equipo_id', $equipo_id, PDO::PARAM_INT);
            $stmt->execute();
        }

        header("Location: listar_asignaciones.php");
        exit;
    }
} else {
    echo "ID de tarea no proporcionado.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Asignación</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-5">Modificar Asignación para <?php echo htmlspecialchars($asignacion['tarea_nombre']); ?></h2>
        <form method="post">
            <div class="mb-3">
                <label for="equipos" class="form-label">Equipos Asignados</label>
                <select name="equipos[]" id="equipos" class="form-control" multiple>
                    <?php
                    $equipos_asignados = explode(',', $asignacion['equipo_ids']);
                    foreach ($equipos as $equipo): ?>
                        <option value="<?php echo $equipo['id']; ?>" <?php echo (in_array($equipo['id'], $equipos_asignados)) ? 'selected' : ''; ?>>
                            <?php echo $equipo['marca'] . " - " . $equipo['procesador']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="listar_asignaciones.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
