<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		$conexion=mysqli_connect("localhost","root","","campeonato");
		$cd=$_REQUEST['codi'];
		$carnet=$_REQUEST['ci'];
		$nom=$_REQUEST['nombre'];
		$apPat=$_REQUEST['Ap_Paterno'];
		$apMat=$_REQUEST['Ap_Materno'];
		$fechanac=$_REQUEST['fechaNac'];
		$sexo=$_REQUEST['sexo'];
		$codEquipo=$_REQUEST['c_equipo'];
		$posi=$_REQUEST['posicion'];
		$consulta="update jugador set ci='$carnet', nombre='$nom', paterno='$apPat', materno='$apMat', fechaNac='$fechanac', sexo='$sexo', codEquipo='$codEquipo' where cod_j=$cd";
		if (isset($_GET['posicion'])){
				$posi=$_GET['posicion'];
		} else {
				"<br>posicion  no es un arreglo<br>";
		}
		if($c_ejecutada=mysqli_query($conexion,$consulta)){
			if(!isset($posi)){
				$longitud=0;
			} else {
				$longitud=count($posi);				
			}
			$consul_rel="select * from rel_ju_po where cod_juga=$cd";
			$rel_ej=mysqli_query($conexion,$consul_rel);
			$numElemRelJug=mysqli_num_rows($rel_ej);

			if($numElemRelJug>0){

				while($c=mysqli_fetch_assoc($rel_ej)){
					if($longitud>0){
						if(!(in_array($c['cod_posi'],$posi,true))){
							$consulta="delete from rel_ju_po where(cod_juga=$cd and cod_posi=".$c['cod_posi'].")";
							mysqli_query($conexion,$consulta);
						}
					}else{
						if($longitud<=0){
							$consulta="delete from rel_ju_po where(cod_juga=$cd and cod_posi=".$c['cod_posi'];
							mysqli_query($conexion,$consulta);
						}
					}
				}
				$long=$longitud;
				for($i=0;$i<$long;$i++){
					$contador=0;
					$rel_ej_1=mysqli_query($conexion,$consul_rel);
					while($c1=mysqli_fetch_assoc($rel_ej_1)){
						//if($posi[$i]===$c1['cod_juga']){
						if($posi[$i]===$c1['cod_posi']){
							$contador++;
						}
					}
					mysqli_free_result($rel_ej_1);
					if($contador<1){
						$consulta="insert into rel_ju_po set cod_posi=".$posi[$i].", cod_juga='$cd'";
						mysqli_query($conexion,$consulta);
					}
				}
			}else{
				foreach($_GET['posicion'] as $idposicion){
					$consulta="insert into rel_ju_po set cod_posi='$idposicion', cod_juga='$cd'";
					mysqli_query($conexion,$consulta);
				}
			}
			echo "<br>Modificaste Jugador <br><br> <a href='listarJugador.php'>Listar Jugador </a>";
		}
		else{
			echo "Error... en Guardar cambios de editar";
		}
	?>
</body>
</html>