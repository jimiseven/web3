<?php
    $conexion=mysqli_connect('localhost','root','','campeonato');
    $nom=$_GET['nomEq'];
    $fec=$_GET['fecha'];
    $col=$_GET['color'];
    $creEq="insert into equipo(nombreEquipo,fechaCreacion,color) values('$nom','$fec','$col')";
    if($conexion->query($creEq)===true){
        echo "<br>Insertaste un nuevo equipo<br><br>
        <a href='listarEquipo.php'>Listar Equipo</a> ";
    }else{
        die("...Error... ".$conexion->error);
    }
?>