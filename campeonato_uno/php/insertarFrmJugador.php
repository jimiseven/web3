<?php
    $conexion=mysqli_connect('localhost','root','','campeonato');
    $sql_eq = "SELECT codEquipo, nombreEquipo FROM equipo";
    $equi = mysqli_query($conexion, $sql_eq);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Jugador</title>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
<body>
        <h1>Insertar Jugador</h1>
        <form action="guardarFrmJugador.php" method="get" class="form">
            CI del Jugador: <input type="number" id="cedula" name="cedula" required><br>
            Nombre del Jugador: <input type="text" id="nombre" name="nombre" required>
            <br> Apellido Paterno: <input type="text" id="ape_pat" name="ape_pat" required>
            <br>Apellidos Materno :<input type="text" id="ape_mat" name="ape_mat" required>
            <br>Fecha de Nacimiento: <input type="date" id="fecha_nac" name="fecha_nac" required>
            <br>Sexo : <input type='radio' name="sexo" value='M'> Masculino 
                    <input type='radio' name="sexo" value='F'>Femenino
                    <br> Equipo: <select id="equi" name="equi">
                    <option value="">elegir equipo</option>
                    <?php while($eq = mysqli_fetch_array($equi)) { 
                        echo "<option value='".$eq['codEquipo']."'>".$eq['codEquipo']." - ".$eq['nombreEquipo'].   
                              "</option>";
                        }
                     ?>
                    </select>
            <br>Posiciones en las juega:<br>
                        Delantero : <input type="checkbox" name="posicion[]"  value="1">
                        Arquero : <input type="checkbox" name="posicion[]"  value="2">
                        Centro Campista : <input type="checkbox" name="posicion[]"  value="3">
                        Defensa : <input type="checkbox" name="posicion[]"  value="4">
            <p><input type="submit" value=Guardar Jugador>
                <input type="reset" name="Cancelar" value="Cancelar">
            </p>
        </form>
</body>
</html>
