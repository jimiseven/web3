<?php
// index.php

// Incluimos el archivo funciones.php usando include
include "funciones.php";

// Usamos las funciones definidas en funciones.php
$resultado_suma = sumar(13, 5);
$resultado_resta = restar(9, 3);

echo "Resultado de la suma: " . $resultado_suma . "<br>";
echo "Resultado de la resta: " . $resultado_resta;
?>