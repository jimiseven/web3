<?php
// index.php

// Incluimos el archivo funciones.php usando require
require "funciones.php";

// Usamos las funciones definidas en funciones.php
$resultado_suma = sumar(13, 7);
$resultado_resta = restar(5, 5);

echo "Resultado de la suma: " . $resultado_suma . "<br>";
echo "Resultado de la resta: " . $resultado_resta;
?>