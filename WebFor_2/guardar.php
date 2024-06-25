<?php

// Incluir la conexión a la base de datos
include "conexion_bd.php";

// Recibir los datos del formulario
$nombreFlor = $_POST["nombreFlor"];
$cantidadCosecha = $_POST["cantidadCosecha"];
$costo = $_POST["costo"];
$idTipo = $_POST["idTipo"];
$fechaProduccion = $_POST["fechaProduccion"];

// Preparar la consulta para registrar la flor
$sql = "INSERT INTO bdflores_v1.flor (nombreFlor, cantidadCosecha, costo, idTipo, fechaProduccion) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

// Vincular los parámetros a la consulta
mysqli_stmt_bind_param($stmt, "sssss", $nombreFlor, $cantidadCosecha, $costo, $idTipo, $fechaProduccion);

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt)) {
    echo "Flor registrada correctamente";
} else {
    echo "Error al registrar la flor: " . mysqli_stmt_error($stmt);
}

// Cerrar la consulta
mysqli_stmt_close($stmt);

// Cerrar la conexión a la base de datos
mysqli_close($conn);
