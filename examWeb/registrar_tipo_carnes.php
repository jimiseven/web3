<?php
include("conexion_bd.php");

// Recoger datos del formulario
$tipoCarne = $_POST['tipoCarne'];

// Insertar datos en la base de datos
$sql = "INSERT INTO tipos_de_carnes (tipo) VALUES ('$tipoCarne')";

if (mysqli_query($conn, $sql)) {
    echo "Tipo de carne registrado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>
