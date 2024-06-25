<?php

// Conexión a la base de datos
$db = new mysqli('localhost', 'root', '', 'flores_v4');

// Comprobar la conexión
if ($db->connect_error) {
    die('Error de conexión: ' . $db->connect_error);
}

// Verificar si los datos están presentes en $_POST
if (isset($_POST['nombreFlor']) && isset($_POST['cantidadCosecha']) && isset($_POST['costo']) && isset($_POST['fechaCosecha']) && isset($_POST['idTipo'])) {
    $nombreFlor = $_POST['nombreFlor'];
    $cantidadCosecha = $_POST['cantidadCosecha'];
    $costo = $_POST['costo'];
    $fechaCosecha = $_POST['fechaCosecha'];
    $idTipo = $_POST['idTipo'];

    // Insertar datos en la tabla `flor`
    $sql = "INSERT INTO flor (nombreFlor, cantidadCosecha, costo, fechaCosecha, idTipo) VALUES ('$nombreFlor', '$cantidadCosecha', '$costo', '$fechaCosecha', '$idTipo')";

    if ($db->query($sql) === TRUE) {
        echo "Flor registrada con éxito";
    } else {
        echo "Error al registrar la flor: " . $db->error;
    }
} else {
    echo "Faltan datos del formulario.";
}

// Cerrar la conexión
$db->close();

?>
