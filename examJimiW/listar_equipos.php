<?php
include 'php/conexion.php'; // Incluir la conexión a la base de datos

// Consulta para obtener todos los equipos
$sql = "SELECT * FROM equipos";
$resultado = $conexion->query($sql); // Ejecutar la consulta

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Equipos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css" /><!-- Asegúrate de tener el archivo Bootstrap local -->
</head>

<body>
    <div class="container">
        <h2 class="mt-5">Lista de Equipos</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Procesador</th>
                    <th>Marca</th>
                    <th>Unidades Disponibles</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado->rowCount() > 0): // Aquí se usa rowCount() 
                ?>
                    <?php while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo $fila['id']; ?></td>
                            <td><?php echo $fila['procesador']; ?></td>
                            <td><?php echo $fila['marca']; ?></td>
                            <td><?php echo $fila['unidades_disponibles']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay equipos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="bootstrap.bundle.min.js"></script> <!-- Asegúrate de tener el archivo Bootstrap local -->
</body>

</html>
<!-- 
<?php
$conexion = null; // Cerrar conexión
?> -->