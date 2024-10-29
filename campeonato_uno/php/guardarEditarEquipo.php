<?php
    $conexion=mysqli_connect('localhost','root','','campeonato');
    $cod=$_GET['codEq'];
    $nom=$_GET['nomEq'];
    $fec=$_GET['fecha'];
    $col=$_GET['color'];
    $consulta="update equipo set nombreEquipo='$nom',
        fechaCreacion='$fec', color='$col' where codEquipo=$cod";
    if($ej_consulta=mysqli_query($conexion,$consulta)){
        echo "<br>Datos modificados correctamente<br><br>
        <a href='listarEquipo.php'>Listar Equipo</a> ";
    }else{
        die("...Error...al editar los datos ");
    }
?>