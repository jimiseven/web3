<?php

// Conexión a la base de datos
$db = new mysqli('localhost', 'root', '', 'test2');

// Comprobar la conexión
if ($db->connect_error) {
    die('Error de conexión: ' . $db->connect_error);
}

// Insertar datos en la tabla `floreria`
$nombreFloreria = $_POST['nombreFloreria'];
$fechaCreacion = $_POST['fechaCreacion'];
$colorPuerta = $_POST['colorPuerta'];
$eslogan = $_POST['eslogan'];

$sql = "INSERT INTO floreria (nombreFloreria, fechaCreacion, colorPuerta, eslogan) VALUES ('$nombreFloreria', '$fechaCreacion', '$colorPuerta', '$eslogan')";

if ($db->query($sql) === TRUE) {
    echo "Florería creada con éxito";
} else {
    echo "Error al crear la florería: " . $db->error;
}

// Cerrar la conexión
$db->close();

?>
