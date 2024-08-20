<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Equipo</title>
</head>
<body>
    <?php
        $conexion=mysqli_connect('localhost','root','','campeonaro');
        $consulta="select * from equipo";
        $ejeConsulta=mysqli_query($conexion,$consulta) or die("...Error al seleccionar Equipo...");
        $nroEquipos=mysqli_num_rows($ejeConsulta);
    ?>
    <table border="1">
        <tr>
            <th>Codigo Equipo</th>
            <th>Nombre</th>
            <th>Fecha Creacion</th>
            <th>Color</th>
        </tr>
        <?php
            if($nroEquipos>0){
                for($i=0;$i<$nroEquipos;$i++){
                    $equipo=mysqli_fetch_array($ejeConsulta);
                    ?>
                    <tr>
                        <td><?php echo $equipo['codEquipo']?></td>
                        <td><?php echo $equipo['nombreEquipo']?></td>
                        <td><?php echo $equipo['fechaCreacion']?></td>
                        <td><?php echo $equipo['color']?></td>
                    </tr>
                <?php
                }
            }
        ?>
    </table>
</body>
</html>