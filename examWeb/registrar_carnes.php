<?php
include("conexion_bd.php");

// Recoger datos del formulario
$nombreCarne = $_POST['nombreCarne'];
$cantidad = $_POST['cantidad'];
$costo = $_POST['costo'];
$idTipo = $_POST['idTipo'];
$fechaProduccion = $_POST['fechaProduccion'];

// Insertar datos en la base de datos
$sql = "INSERT INTO carnes (nombre, cantidad, costo, id_tipo, fecha_produccion) VALUES ('$nombreCarne', '$cantidad', '$costo', '$idTipo', '$fechaProduccion')";

if (mysqli_query($conn, $sql)) {
    echo "Carne registrada exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>
