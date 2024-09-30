<?php
// Archivo: logica.php

// Incluir el archivo de conexión
include 'php/conexion.php';

// Lógica para obtener datos de clientes
$sqlClientes = "SELECT * FROM clientes";
$resultadoClientes = $conn->query($sqlClientes);

// Lógica para obtener los platos disponibles
$sqlPlatos = "SELECT * FROM menus";
$resultadoPlatos = $conn->query($sqlPlatos);

// Cerrar la conexión al final del script
$conn->close();
?>
