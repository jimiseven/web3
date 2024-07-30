<?php


// Crear la conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '', 'bdflores_v1');

// Comprobar la conexión
if (!$conn) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}
