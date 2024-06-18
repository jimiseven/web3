<?php

$notaEstudiante = 85; // Cambia este valor para probar diferentes casos

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Estudiante</title>
</head>
<body>

    <h3>Forma 1</h3>
    <?php
        if ($notaEstudiante >= 90) {
            echo "<b>¡Excelente! Has obtenido una calificación sobresaliente.</b>";
        } elseif ($notaEstudiante >= 70) {
            echo "<b>¡Buen trabajo! Has aprobado con una buena calificación.</b>";
        } else {
            echo '<i>Lo siento, no has aprobado. Necesitas estudiar más.</i>';
        }
    ?>

    <br>

    <h3>Forma 2</h3>
    <?php if ($notaEstudiante >= 90) { ?>
        <b>¡Excelente! Has obtenido una calificación sobresaliente.</b>
    <?php } elseif ($notaEstudiante >= 70) { ?>
        <b>¡Buen trabajo! Has aprobado con una buena calificación.</b>
    <?php } else { ?>
        <i>Lo siento, no has aprobado. Necesitas estudiar más.</i>
    <?php } ?>

    <br>

    <h3>Forma 3</h3>
    <?php if ($notaEstudiante >= 90) : ?>
        <b>¡Excelente! Has obtenido una calificación sobresaliente.</b>
    <?php elseif ($notaEstudiante >= 70) : ?>
        <b>¡Buen trabajo! Has aprobado con una buena calificación.</b>
    <?php else : ?>
        <i>Lo siento, no has aprobado. Necesitas estudiar más.</i><br>
        <i>No te desanimes, ¡puedes mejorar!</i><br>
        <i>¡Sigue intentándolo!</i><br>
        <i>El esfuerzo vale la pena.</i><br>
    <?php endif; ?>

</body>
</html>
