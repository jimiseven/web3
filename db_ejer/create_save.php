<?php

// Conexión a la base de datos
$db = new mysqli('localhost', 'usuario', 'contraseña', 'base_de_datos');

// Comprobar la conexión
if ($db->connect_error) {
    die('Error de conexión: ' . $db->connect_error);
}

// Si el formulario se ha enviado
if (isset($_POST['nombreFloreria'])) {
    // Obtener los datos del formulario
    $nombreFloreria = $_POST['nombreFloreria'];
    $fechaCreacion = $_POST['fechaCreacion'];
    $colorPuerta = $_POST['colorPuerta'];
    $eslogan = $_POST['eslogan'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO floreria (nombreFloreria, fechaCreacion, colorPuerta, eslogan) VALUES ('$nombreFloreria', '$fechaCreacion', '$colorPuerta', '$eslogan')";

    if ($db->query($sql) === TRUE) {
        echo "Nuevo elemento creado correctamente";
    } else {
        echo "Error al crear el nuevo elemento: " . $db->error;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear florería</title>
</head>
<body>

<h1>Crear florería</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="nombreFloreria">Nombre de la florería:</label>
    <input type="text" id="nombreFloreria" name="nombreFloreria" required><br>

    <label for="fechaCreacion">Fecha de creación:</label>
    <input type="date" id="fechaCreacion" name="fechaCreacion" required><br>

    <label for="colorPuerta">Color de la puerta:</label>
    <input type="text" id="colorPuerta" name="colorPuerta" required><br>

    <label for="eslogan">Eslogan:</label>
    <textarea id="eslogan" name="eslogan" rows="5" cols="30" required></textarea><br>

    <input type="submit" value="Crear florería">
</form>

</body>
</html>
