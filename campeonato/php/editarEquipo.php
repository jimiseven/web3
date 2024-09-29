<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        $conexion=mysqli_connect('localhost','root','','webCampeonato');
        $cod=$_REQUEST['codEquipo'];
        $select = "select codEquipo, nombreEquipo, fechaCreacion, color from equipo where codEquipo = $cod";
        $select_ej=mysqli_query($conexion, $select) or die("...Error en la tabla");
        $valores = mysqli_fetch_array($select_ej);

    ?>

    <form action="guardarEditar.php">

        <h2>Editar Equipo</h2>
        <h3>Codigo de Equipo: </h3>
        <input type="hidden" name="codEq" value="<?php echo $valores['codEquipo']?>">
        <h3>Nombre de Equipo: </h3>
        <input type="text" name="nomEq" value="<?php echo $valores['nombreEquipo']?>">
        <h3>Fecha de Creacion: </h3>
        <input type="date" name="fecha" value="<?php echo $valores['fechaCreacion']?>">
        <h3>Color de Equipo: </h3>
        <input type="text" name="color" value="<?php echo $valores['color']?>">

        <input type="submit" value="Guardar Cambios">
        <input type="cancel" value="Cancelar">

    </form>

</body>
</html>