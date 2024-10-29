<?php
    ob_start();
?>
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
    <h1>REPORTE DE JUGADORES</h1>
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
</body>
</html>
<?php
    $html=ob_get_clean();//para obtener el contenido del bufer actual
    require_once "../../libreria/dompdf/autoload.inc.php";
    use Dompdf\Dompdf;
    $dompdf=new Dompdf();// objeto que me permitirá trabajar con 
                //las conversiones de html a pdf
    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter');
    $dompdf->render();
    $dompdf->stream("nomPDFJUGADOR.pdf",array("Attachement"=>false));
    //false para que se visualice el pdf generado
?>