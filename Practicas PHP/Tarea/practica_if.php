<?php

$condicion = false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condicionales</title>
</head>
<body>

    <h3>Forma 1</h3>
        <?php
            // Esta es la primera forma de usar una condicional en PHP dentro de HTML.
            if ($condicion){
                // Si la condición es verdadera, se imprime el siguiente texto en negrita.
                echo "<b>La condicional es Verdadero</b>";
            } else {
                // Si la condición es falsa, se imprime el siguiente texto en cursiva.
                echo '<i>La condicion es Falso</i>';
            }
            // Cierra la sección de PHP con `?>`.
        ?>

    <br>

    <h3>Forma 2</h3>
    <?php if ($condicion) { ?>
        <!-- Alternamos entre PHP y HTML. -->
        <!-- Si la condición es verdadera, se imprime el siguiente texto en negrita. -->
        <b>La condicion es verdadero</b>
    <?php } else { ?>
        <!-- Si la condición es falsa, se imprime el siguiente texto en cursiva. -->
        <i>La condicion es falso</i>
    <?php } ?>
    <!-- Se abre una sección PHP para la condición, luego se cierra para incluir HTML, y se abre nuevamente para el else. -->

    <br>

    <h3>Forma</h3>
    <?php if ($condicion) : ?>
        <!-- Si la condición es verdadera, se imprime el siguiente texto en negrita. -->
        <b>La condicion es verdadero</b>
    <?php else : ?>
        <!-- Si la condición es falsa, se imprime el siguiente texto en cursiva. -->
        <i>La condicion es falso</i><br>
        <i>La condicion es falso</i><br>
        <i>La condicion es falso</i><br>
        <i>La condicion es falso</i><br>
        <i>La condicion es falso</i><br>
    <?php endif; ?>
    <!-- Utilizamos la sintaxis alternativa de PHP para estructuras de control (if: ... else: ... endif;). -->
        
</body>
</html>