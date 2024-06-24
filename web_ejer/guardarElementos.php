<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardado</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <br>
    <a href="listarElementos.php" class="btn btn-outline-primary d-block mx-auto">Listar Florerías</a><br>
    <a href="index.html" class="btn btn-outline-primary d-block mx-auto">Insertar otra</a><br>
</body>

</html>
<?php

// Conexión a la base de datos
$db = new mysqli('localhost', 'root', '', 'Floreria');

// Comprobar la conexión
if ($db->connect_error) {
    die('Error de conexión: ' . $db->connect_error);
}

// Insertar datos en la tabla `floreria`
$nombreFloreria = $_POST['nombreFloreria'];
$fechaCreacion = $_POST['fechaCreacion'];
$localizacion = $_POST['localizacion'];
$eslogan = $_POST['eslogan'];

$sql = "INSERT INTO floreria (nombreFloreria, fechaCreacion, localizacion, eslogan) VALUES ('$nombreFloreria', '$fechaCreacion', '$localizacion', '$eslogan')";

if ($db->query($sql) === TRUE) {
    echo "Florería creada con éxito";
} else {
    echo "Error al crear la florería: " . $db->error;
}


// Cerrar la conexión
$db->close();



?>