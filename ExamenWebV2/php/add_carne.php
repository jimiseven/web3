<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $proveedorID = $_POST['proveedor'];

    $sql = "INSERT INTO Carnes (Nombre, Tipo, Precio, ProveedorID) VALUES ('$nombre', '$tipo', '$precio', '$proveedorID')";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva carne registrada exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
