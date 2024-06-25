<?php


// Crear la conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '', 'test2');

// Comprobar la conexión
if (!$conn) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}
