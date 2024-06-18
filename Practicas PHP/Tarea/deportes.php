<?php

$resultadoPartido = true; // Cambia a false para probar el otro caso

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Partido</title>
</head>
<body>

    <h3>Forma 1</h3>
    <?php
        if ($resultadoPartido){
            echo "<b>¡Felicidades! El equipo ha ganado el partido.</b>";
        } else {
            echo '<i>Lo siento, el equipo ha perdido el partido.</i>';
        }
    ?>

    <br>

    <h3>Forma 2</h3>
    <?php if ($resultadoPartido) { ?>
        <b>¡Felicidades! El equipo ha ganado el partido.</b>
    <?php } else { ?>
        <i>Lo siento, el equipo ha perdido el partido.</i>
    <?php } ?>

    <br>

    <h3>Forma 3</h3>
    <?php if ($resultadoPartido) : ?>
        <b>¡Felicidades! El equipo ha ganado el partido.</b>
    <?php else : ?>
        <i>Lo siento, el equipo ha perdido el partido.</i><br>
        <i>¡Intenta nuevamente en el próximo partido!</i><br>
        <i>¡No te desanimes!</i><br>
        <i>¡El esfuerzo es lo que cuenta!</i><br>
    <?php endif; ?>
    
</body>
</html>
