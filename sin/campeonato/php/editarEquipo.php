<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo</title>
</head>
<body>
    <h1>Editar Equipo</h1>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $hostname="localhost";
        $database="base_datos";
        $username="usuario";
        $password="contraseña";

        $conexion=mysqli_connect($hostname,$username,$password,$database);
        $consulta="SELECT * FROM equipo WHERE id='{$id}'";
        $resultado=mysqli_query($conexion,$consulta);

        if ($registro=mysqli_fetch_array($resultado)) {
            $nombre = $registro['nombre'];
            $descripcion = $registro['descripcion'];
        } else {
            echo "No se encontró el equipo.";
            exit;
        }

        mysqli_close($conexion);
    } else {
        echo "ID de equipo no especificado.";
        exit;
    }
    ?>

    <form action="guardarEquipo.php" method="get">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required><br><br>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" required><br><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
