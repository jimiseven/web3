<?php
include 'connect.php';

$sql = "SELECT ProveedorID, Nombre FROM Proveedores";
$result = $conn->query($sql);

$proveedores = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $proveedores[] = $row;
    }
}

echo json_encode($proveedores);

$conn->close();
?>
