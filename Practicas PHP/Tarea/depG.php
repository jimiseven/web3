<?php

$esFinDeSemana = false; // Cambia a true para probar el otro caso

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad del Día</title>
</head>
<body>

    <h3>Forma 1</h3>
    <?php
        if ($esFinDeSemana) {
            echo "<b>¡Es fin de semana! Disfruta tu tiempo libre.</b>";
        } else {
            echo '<i>Es un día de semana. ¡A trabajar!</i>';
        }
    ?>

    <br>

    <h3>Forma 2</h3>
    <?php if ($esFinDeSemana) { ?>
        <b>¡Es fin de semana! Disfruta tu tiempo libre.</b>
    <?php } else { ?>
        <i>Es un día de semana. ¡A trabajar!</i>
    <?php } ?>

    <br>

    <h3>Forma 3</h3>
    <?php if ($esFinDeSemana) : ?>
        <b>¡Es fin de semana! Disfruta tu tiempo libre.</b>
    <?php else : ?>
        <i>Es un día de semana. ¡A trabajar!</i><br>
        <i>Recuerda tomar descansos cortos.</i><br>
        <i>Mantén tu productividad alta.</i><br>
        <i>¡Tú puedes hacerlo!</i><br>
    <?php endif; ?>

</body>
</html>
