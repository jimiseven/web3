<?php
// Conexión a la base de datos
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

// Obtener datos del formulario
$nombreCarne = $_POST['nombreCarne'];
$cantidadProduccion = $_POST['cantidadProduccion'];
$costo = $_POST['costo'];
$nombreTipo = $_POST['nombreTipo'];
$fechaProduccion = $_POST['fechaProduccion'];

// Insertar datos en la tabla carnes
$sql = "INSERT INTO carnes (nombreCarne, cantidadProduccion, costo, nombreTipo, fechaProduccion) VALUES ('$nombreCarne', '$cantidadProduccion', '$costo', '$nombreTipo', '$fechaProduccion')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
