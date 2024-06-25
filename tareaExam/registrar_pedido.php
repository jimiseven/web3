<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "floreria_v3";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombreFlor = $_POST['nombreFlor'];
$cantidadPedido = $_POST['cantidadPedido'];
$costo = $_POST['costo'];
$idProveedor = $_POST['idProveedor'];
$idTipo = $_POST['idTipo'];

$sql = "INSERT INTO flor (nombreFlor, cantidadPedido, costo, idProveedor, idTipo)
VALUES ('$nombreFlor', '$cantidadPedido', '$costo', '$idProveedor', '$idTipo')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo pedido registrado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
