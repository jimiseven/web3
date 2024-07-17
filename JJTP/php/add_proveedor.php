<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO Proveedores (Nombre, Telefono, Direccion) VALUES ('$nombre', '$telefono', '$direccion')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo proveedor registrado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
