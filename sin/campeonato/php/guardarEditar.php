<?php
$conexion = mysqli_connect('localhost', 'root', '','campeonaro');
$cod=$_GET['codEq'];
$nom=$_GET['nomEq'];
$fec=$_GET['fecha'];
$col=$_GET['color'];
$ediEq="update `equipo` set `nombreEquipo`='$nom',`fechaCreacion`='$fec',`color`='$col' WHERE codEquipo = $cod";

if($conexion->query($ediEq)===true){
    echo"<br>Editaste un nuevo equipo<br> ";
}else{
    die("...Error...".$conexion->error);
}
?>
<a href="listarEquipo.php">Volver a la lista de los Equipos</a>