<?php
// Datos de la base de datos
$host = 'localhost';  // O el host de tu servidor de base de datos
$dbname = 'proyectos2';  // Nombre de la base de datos (ajustar según sea necesario)
$user = 'root';  // Usuario de la base de datos
$password = '';  // Contraseña del usuario de la base de datos (ajustar según sea necesario)

try {
    // Crear una conexión usando PDO
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    // Configurar el modo de error de PDO a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Establecer el conjunto de caracteres a UTF8
    $conexion->exec("set names utf8");

    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    // Manejo de errores
    // echo "Error de conexión: " . $e->getMessage();
}
?>
