<?php
// Datos de la conexión
$servidor = "localhost";
$usuario = "root";
$contrasena = ""; // Si tienes contraseña, colócala aquí
$basedatos = "reservas_restaurante";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $basedatos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa a la base de datos";
?>
