<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Equipo</title>
</head>
<body>
    <?php
        $conexion=mysqli_connect('localhost','root','','campeonato');
        $consulta="select * from jugador";
        $ejeConsulta=mysqli_query($conexion,$consulta) or die("...Error al seleccionar Equipo...");
        $nroJugadores=mysqli_num_rows($ejeConsulta);
    ?>
    <table border="1">
        <tr>
            <th>Codigo Jugador</th>
            <th>CI</th>
            <th>Nombre</th>
            <th>Ap Paterno</th>
            <th>Ap Materno</th>
            <th>Fecha Nacimiento</th>
            <th>Sexo</th>
            <th>Cod Equipo</th>
        </tr>
        <?php
            if($nroJugadores>0){
                for($i=0;$i<$nroJugadores;$i++){
                    $jugador=mysqli_fetch_array($ejeConsulta);
                    ?>
                    <tr>
                        <td><?php echo $jugador['cod_j']?></td>
                        <td><?php echo $jugador['ci']?></td>
                        <td><?php echo $jugador['nombre']?></td>
                        <td><?php echo $jugador['paterno']?></td>
                        <td><?php echo $jugador['materno']?></td>
                        <td><?php echo $jugador['fechaNac']?></td>
                        <td><?php echo $jugador['sexo']?></td>
                        <td><?php echo $jugador['codEquipo']?></td>
                    </tr>
                <?php
                }
            }
        ?>
    </table>
    <p><a href="" onclick='window.print()'>1ra forma de Împrimir </a></p>
    <p><a href="generarExcel.php"> generar archivo Excel </a></p>
    <p><a href="generarWord.php"> generar archivo Word </a></p>
    <p><a href="generarPDF.php"> PDF de prueba </a></p>
    <p><a href="generarPDFjugador.php">Genera PDF de Jugador </a></p>
    <p><a href="../../index.html">Volver al Menu Principal</a></p>
</body>
</html>