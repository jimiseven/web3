<?php
$servername = "localhost";
$username = "root"; // reemplaza 'root' con tu nombre de usuario de MySQL
$password = ""; // reemplaza con tu contraseña de MySQL
$dbname = "carnesDB";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>
