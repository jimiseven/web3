<?php
$servername = "localhost"; // O la dirección de tu servidor, por ejemplo, "127.0.0.1" o "localhost"
$username = "root"; // Cambia esto por tu nombre de usuario de MySQL
$password = ""; // Cambia esto por tu contraseña de MySQL
$dbname = "webcampeonato"; // El nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Si todo va bien, imprime un mensaje de éxito
// echo "Conexión exitosa a la base de datos";
?>
