<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	$conexion=mysqli_connect("localhost","root","","campeonato");
	$codigoJ=$_REQUEST['codJ'];
	$borrar="delete from jugador where cod_j=".$codigoJ;
	mysqli_query($conexion,$borrar) or die ("Error... al eliminar jugador");
	echo "Eliminaste un Jugador... <br>
	<a href='listarJugador.php'>Volver a lista de Jugadores </a>";
	?>

</body>
</html>