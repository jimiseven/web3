<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<!--style type="text/css">
		* html{
			font-family: segoe UI Light;
			background: FFFF;
			text-align: center;
		}
		.block{
			background: #ddd;
			margin: 1em 2em ;
			padding: 1em 3em;
			text-align: left;
		}
		.form{
			background: #ddd;
			/*margin: 2em;*/
			padding: 3em;
			width: 30em;
			margin-left: 23em;
		}
	</!--style-->
</head>
<body>
	<?php
		$conexion=mysqli_connect('localhost','root','','campeonato');
		$codi=$_REQUEST['codJ'];

        $select="select * from jugador where cod_j=$codi";
		$ejecuta_jug=mysqli_query($conexion,$select) or die("Error... en la tabla Jugador");
		$equipo=mysqli_fetch_array($ejecuta_jug);		

		$equi=$equipo['codEquipo'];

		$consul_E="select codEquipo, nombreEquipo from equipo order by codEquipo asc";
		$ejecuta_E=mysqli_query($conexion,$consul_E) or die ("..Error al seleccionar Club...");
		//consulta posicion
		$consulta_Pos="select cod_posi from rel_ju_po where cod_juga=$codi";
		echo "<br>la consulta posicion es : $consulta_Pos<br>";
		
		$ejecuta_Pos=mysqli_query($conexion,$consulta_Pos) or die(".. Error al seleccionar posicion........");

		$posicion=array();
		$codRel=array();

		//generamos un array asociativo en base a las posiciones recuperadas
		while($c=mysqli_fetch_assoc($ejecuta_Pos)){
			$posicion[]=$c['cod_posi'];
		}
	?>

	<form action="guardarEditarJugador.php" class="form" method="GET">
	  <!--h2>Editar Jugador</h2-->
	   <div class="block">
	   	<h2>Editar Jugador</h2>
		<h3>Codigo : </h3>
		<input type="number" name="codi" value="<?php echo $equipo['cod_j'] ?>" readonly>
		<h3>CI : </h3>
		<input type="number" name="ci" value="<?php echo $equipo['ci'] ?>">
		<h3>Nombre : </h3>
		<input type="text" name="nombre" value="<?php echo $equipo['nombre'] ?>">
		<h3>Apellido Paterno : </h3>
		<input type="text" name="Ap_Paterno" value="<?php echo $equipo['paterno'] ?>">
		<h3>Apellido Materno : </h3>
		<input type="text" name="Ap_Materno" value="<?php echo $equipo['materno'] ?>">
		<h3>Fecha de Nacimiento : </h3>
		<input type="date" name="fechaNac" value="<?php echo $equipo['fechaNac'] ?>">
		<h3>Sexo : </h3>
		<input type="radio" name="sexo" value="M" <?php if($equipo['sexo']=="M") echo "checked"; ?>>Varon
		<input type="radio" name="sexo" value="F"<?php if($equipo['sexo']=="F") echo "checked";?>> Mujer

		<h3>Equipo : </h3>

		Pertenece al Equipo
			<select name="c_equipo">
			<?php
				while($fila=mysqli_fetch_array($ejecuta_E)){
					$coEqui=$fila['codEquipo'];
					$nomEqui=$fila['nombreEquipo'];
					if($coEqui==$equi){
						?>
						<option value="<?php echo $coEqui;?>"selected>
							<?php echo $coEqui." - ".$nomEqui?>		
						</option>
					<?php
					}else
					echo "<option value='".$fila['codEquipo']."'>".
						$fila['codEquipo']." - ".$fila['nombreEquipo'].
						"<option>";
				}				
			?>				
			</select>

			<p><label>Posición</label></p>
			<input type="checkbox" value="1" <?php if(in_array("1",$posicion)){echo 'checked="checked"';} ?> 
				name="posicion[]">Delantero
			<input type="checkbox" value="2" <?php if(in_array("2",$posicion)){echo 'checked="checked"';} ?> 
				name="posicion[]">Arquero
			<input type="checkbox" value="3" <?php if(in_array("3",$posicion)){echo 'checked="checked"';} ?> 
				name="posicion[]">Centro
			<input type="checkbox" value="4" <?php if(in_array("4",$posicion)){echo 'checked="checked"';} ?> 
				name="posicion[]">Defena			
		<br><br>
		<input type="submit" name="enviar" value="Guardar Cambios">
	   </div>
	</form>
	<h3><a href=".../index.html"></a></h3>
</body>
</html>