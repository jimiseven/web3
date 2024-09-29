<?php
// Datos de conexión
$host = "localhost";        // Servidor (puede ser 'localhost' si trabajas localmente)
$dbname = "reservas_restaurante"; // Nombre de la base de datos
$username = "root";         // Usuario de la base de datos
$password = "";             // Contraseña (si usas XAMPP o MAMP, usualmente la contraseña es vacía)

// Crear la conexión
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// echo "Conexión exitosa a la base de datos 'reservas_restaurante'";

?>
